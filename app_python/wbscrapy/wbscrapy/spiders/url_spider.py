import re

from scrapy import Request
from scrapy.spiders import Spider

from common.db import Db
from common.models import Product
from common.product_service import ProductService


class ProductsSpider(Spider):
    name = "url"

    def __init__(self, url=''):
        super().__init__()

        self.db = Db()
        self.session = self.db.get_session()

        if url != '':
            self.start_urls.append(url)

    def parse(self, response, **kwargs):
        for href in response.css('a.j-open-full-product-card::attr(href)').extract():
            self.process_product_page(response.urljoin(href))

        active_page = int(response.css('span.pagination-item.active::text').get())
        next_pages = response.css('a.pagination-item::attr(href)').extract()

        for next_page in next_pages:
            result = re.findall(r'page=(\d+)', next_page)

            if result and int(result[0]) > active_page:
                yield Request(response.urljoin(next_page), callback=self.parse)

    def process_product_page(self, href):
        product_data = ProductService.parse_product_url(href)

        if product_data:
            product = self.session.query(Product).filter_by(domain=product_data['domain'], code=product_data['code']).first()

            if not product:
                self.session.add(Product(domain=product_data['domain'], code=product_data['code'], status=Product.STATUS_NEW))
                self.session.commit()
