class ProductService:
    @staticmethod
    def build_url(product):
        return f'https://www.wildberries.{product.domain}/catalog/{product.code}/detail.aspx'
