from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

import common.env as env


class Db:
    def __init__(self):
        self.engine = create_engine('postgresql+psycopg2://{user}:{password}@{host}:{port}/{database}'.format(
            user=env.POSTGRES_USER,
            password=env.POSTGRES_PASS,
            host=env.POSTGRES_HOST,
            port=env.POSTGRES_PORT,
            database=env.POSTGRES_DB,
            echo=True
        ))

        self.session_maker = sessionmaker(bind=self.engine)

    def get_session(self):
        return self.session_maker()
