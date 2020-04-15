import os

POSTGRES_USER = os.getenv('POSTGRES_WB_USER', 'wbmonitor')
POSTGRES_PASS = os.getenv('POSTGRES_WB_PASS', 'wbmonitor')
POSTGRES_HOST = os.getenv('POSTGRES_HOST', 'localhost')
POSTGRES_PORT = os.getenv('POSTGRES_PORT', 5432)
POSTGRES_DB = os.getenv('POSTGRES_DB', 'wbmonitor')

# PRODUCT_REGEXP = r'https:\/\/[www.]*wildberries.\w{2}\/catalog\/\d+\/detail.aspx'
#
# MAX_PRODUCT_COUNT = int(os.getenv('MAX_PRODUCT_COUNT', 30))
#
# BOT_TOKEN = os.getenv('BOT_TOKEN')
# NOTIFY_INTERVAL = 60 * 10
#
# LOG_DIR = os.getenv('LOG_DIR', '/var/log/container')
# DATA_DIR = os.getenv('DATA_DIR', '/etc/data')
#
# RMQ_PORT = os.getenv('RABBITMQ_PORT', 5672)
# RMQ_USER = os.getenv('RABBITMQ_DEFAULT_USER')
# RMQ_PASS = os.getenv('RABBITMQ_DEFAULT_PASS')
#
# RMQ_EXCHANGE = 'wbscrapy'
# RMQ_QUEUE_NEW_PRODUCT = 'new.product'
