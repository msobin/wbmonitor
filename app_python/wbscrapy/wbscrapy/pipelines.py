# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html

from common.models import *


class PostgresPipeline(object):
    def __init__(self):
        pass

    def open_spider(self, spider):
        pass

    def close_spider(self, spider):
        pass

    def process_item(self, item, spider):
        product = spider.products[item.get('url')]

        picker = list(map(lambda code: int(code), item.get('picker', [])))
        picker = list(filter(lambda code: code != product.code, picker))

        if product.status == Product.STATUS_NEW:
            for code in picker:
                if not spider.session.query(Product).filter_by(code=code).first():
                    spider.session.add(
                        Product(code=code, domain=product.domain, status=Product.STATUS_SATELLITE))

        product.status = Product.STATUS_REGULAR
        product.name = item.get('name')
        product.description = item.get('description')
        product.brand_id = self.get_brand_id(spider, item.get('brand'))
        product.images = item.get('images', [])
        product.picker = picker
        product.sizes = item.get('sizes')
        product.updated_at = datetime.datetime.now()
        product.category_ids = self.get_category_ids(spider, item.get('categories'))
        product.params = item.get('params')

        item_price = item.get('price')

        if not product.price:
            spider.session.add(ProductPrice(product_id=product.id, value=item_price))
            spider.session.add(ProductPriceHistory(product_id=product.id, value=item_price))
        else:
            if product.price.value != item_price:
                product.price.value_prev = product.price.value
                product.price.value = item_price
                spider.session.add(ProductPriceHistory(product_id=product.id, value=item_price))

        spider.session.commit()

        return item

    @staticmethod
    def get_brand_id(spider, title):
        # critical section ?
        if title in spider.brands:
            model = spider.brands[title]
        else:
            model = spider.session.query(Brand).filter_by(title=title).first()

            if not model:
                model = Brand(title=title)
                spider.session.add(model)
                spider.session.commit()

        spider.brands[title] = model

        return model.id

    @staticmethod
    def get_category_ids(spider, categories):
        # critical section ?
        category_ids = []

        if categories is None:
            return category_ids

        for category in categories:
            if category in spider.categories:
                model = spider.categories[category]
            else:
                model = spider.session.query(Category).filter_by(title=category).first()

                if not model:
                    model = Category(title=category)
                    spider.session.add(model)
                    spider.session.commit()

            spider.categories[category] = model
            category_ids.append(model.id)

        return category_ids
