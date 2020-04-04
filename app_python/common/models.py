import datetime

from sqlalchemy import Column, Integer, String, DateTime, ForeignKey, ARRAY
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import relationship

Base = declarative_base()


class Product(Base):
    __tablename__ = 'product'

    STATUS_NEW = 1
    STATUS_REGULAR = 2

    id = Column(Integer, primary_key=True)
    domain = Column(String)
    code = Column(Integer)
    name = Column(String)
    status = Column(Integer, default=STATUS_NEW)
    images = Column(ARRAY(String), default=[])
    picker = Column(ARRAY(Integer), default=[])
    ref_count = Column(Integer, default=0)
    sizes = Column(ARRAY(String), default=[])
    brand_id = Column(Integer, ForeignKey('brand.id'))
    category_ids = Column(ARRAY(Integer), default=[])
    created_at = Column(DateTime, default=datetime.datetime.now)
    updated_at = Column(DateTime, default=datetime.datetime.now, onupdate=datetime.datetime.now)

    current_price = relationship('ProductPrice', order_by='desc(ProductPrice.id)', uselist=False)
    prices = relationship('ProductPrice', order_by='desc(ProductPrice.id)')
    brand = relationship('Brand')


class ProductPrice(Base):
    __tablename__ = 'product_price'

    STATUS_NEW = 1
    STATUS_PROCESSED = 2

    id = Column(Integer, primary_key=True)
    product_id = Column(Integer, ForeignKey('product.id'))
    value = Column(Integer)
    status = Column(Integer, default=STATUS_NEW)
    created_at = Column(DateTime, default=datetime.datetime.now)
    updated_at = Column(DateTime, default=datetime.datetime.now, onupdate=datetime.datetime.now)

    product = relationship('Product')


class Category(Base):
    __tablename__ = 'category'

    id = Column(Integer, primary_key=True)
    title = Column(String)
    created_at = Column(DateTime, default=datetime.datetime.now)


class Brand(Base):
    __tablename__ = 'brand'

    id = Column(Integer, primary_key=True)
    title = Column(String)
    created_at = Column(DateTime, default=datetime.datetime.now)
