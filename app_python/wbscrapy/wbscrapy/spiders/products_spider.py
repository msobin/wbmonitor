import scrapy
from scrapy.loader import ItemLoader
from sqlalchemy import func
from wbscrapy.items import ProductItem

from common.db import Db
from common.models import *
from common.product_service import ProductService


class ProductsSpider(scrapy.Spider):
    name = "products"

    def __init__(self):
        super().__init__()

        self.db = Db()
        self.session = self.db.get_session()

        products = self.session.query(Product).all()
        self.products = {ProductService.build_url(product): product for product in products}

        if not self.products:
            return

        self.start_urls = self.products.keys()

        brands = self.session.query(Brand).filter(Brand.id.in_([product.brand_id for product in products])).all()
        self.brands = {brand.title: brand for brand in brands}

        category_ids = self.session.query(func.unnest(Product.category_ids)) \
            .filter(Product.id.in_([product.id for product in products])).distinct()
        categories = self.session.query(Category) \
            .filter(Category.id.in_(category_ids)).all()

        self.categories = {catalog_category.title: catalog_category for catalog_category in categories}

    def parse(self, response, **kwargs):
        loader = ItemLoader(item=ProductItem(), response=response)

        loader.add_value('url', response.url)
        loader.add_xpath('code', '//span[@class="j-article"]/text()')
        loader.add_xpath('picker', '//div[contains(@class, "colorpicker")]/ul/li/@data-cod1s')
        loader.add_xpath('brand', '//span[@class="brand"]/text()')
        loader.add_xpath('name', '//span[@class="name"]/text()')
        loader.add_xpath('images',
                         '//div[contains(@class, "pv-carousel")]//a[contains(@class, "j-carousel-image")]/@href')
        loader.add_xpath('price', '//span[@class="final-cost"]/text()')
        loader.add_xpath('description', '//div[contains(@class, "description-text")]/p/text()')
        loader.add_xpath('categories', '//ul[@class="bread-crumbs"]/li/a')
        loader.add_xpath('sizes',
                         '//div[contains(@class, "size-list") and not(contains(@class, "hide"))]/label[not(contains(@class, "disabled"))]/@data-size-name')
        loader.add_xpath('params', '//div[@class="params"]//div[@class="pp"]')

        return loader.load_item()
