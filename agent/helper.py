import scrapy
from scrapy.utils.markup import remove_tags
from urllib.parse import urlparse

class Helper(scrapy.Item):
    def get_domain(self, res_url):
        parsed_uri = urlparse(res_url)
        domain = '{uri.scheme}://{uri.netloc}/'.format(uri=parsed_uri)
        return domain

    def rm_tags(self, text):
        return remove_tags(text).replace("\n",' ')

    def chk_tfidf(self, text):
        return True