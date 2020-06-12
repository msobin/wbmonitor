import re
from urllib import parse
from common.env import PRODUCT_REGEXP


class ProductService:
    @staticmethod
    def build_url(product):
        return f'https://www.wildberries.{product.domain}/catalog/{product.code}/detail.aspx'

    def parse_product_url(url):
        matches = re.findall(PRODUCT_REGEXP, url)

        if matches:
            parsed_uri = parse.urlparse(matches[0])
        else:
            return

        domain = parsed_uri.netloc.split('.')[-1]
        code = int("".join(filter(lambda c: c.isdigit(), parsed_uri.path)))

        return {'domain': domain, 'code': code}

