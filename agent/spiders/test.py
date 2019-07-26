# -*- coding: utf-8 -*-
import scrapy


class TestSpider(scrapy.Spider):
    name = 'test'
    allowed_domains = ['http://www.linnonlinestore.com']
    start_urls = ['http://www.linnonlinestore.com/acer-aspire-e5-476-i3-laptop/']

    def parse(self, response):
        a = response.css(".title::text")[0].extract()
        print(a)
        yield response.css(".title::text")[0].extract()

