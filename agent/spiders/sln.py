# -*- coding: utf-8 -*-
# ယခု Program လေးကိုတော့ဖြင့် Error ပေါင်း သောင်းခြောက်ထောင်နဲ့ သော်ဒီဇင်လေးမှ ရေးသားထားပါတယ် 🤣🤣🤣
# 🕸🕷🕸🕸 Scrapy with Python 3.7.3 🐍

from scrapy.item import Field, Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from agent.items import AgentItem
from scrapy.utils.markup import remove_tags

def rrm_tags(self, text):
    return remove_tags(text).replace("\n",' ')

class LinnSpider(CrawlSpider):
    name = "sln"
    allowed_domains = ["linnonlinestore.com","sln-myanmar.com","royalsmartmm.com"]
    start_urls = ["http://sln-myanmar.com/"]#,"http://sln-myanmar.com/","http://royalsmartmm.com"]

    rules = (
        Rule(LinkExtractor(deny=["career","about-us","partners","events"]),
        callback='parse_page', follow=True),
    )

    def parse_page(self, response):
        #response.replace(url='http://www.linnonlinestore.com/acer-aspire-e5-476-i3-laptop/')
        item = AgentItem()
        current_url = AgentItem.get_domain(self, response.url)
        if current_url == 'http://sln-myanmar.com/':
            text = AgentItem.rm_tags(self, response.url)
            text_pass = AgentItem.chk_tfidf(self, text)
            
            if text_pass == True:
                item = AgentItem.sln_method(self, response, item)
                return item
            

        # if current_url == 'http://sln-myanmar.com/':
        #     print("2222222222222222222222222222222")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         
        #         item = AgentItem.sln_method(self, response, item)
        #         return item

        # if current_url == 'http://royalsmartmm.com':
        #     print("3333333333333333333333333333333")
        #     text = AgentItem.rm_tags(self, response.url)
        
        #return item


        # asdfsdfa
        