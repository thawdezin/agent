# -*- coding: utf-8 -*-
# ယခု Program လေးကိုတော့ဖြင့် Error ပေါင်း သောင်းခြောက်ထောင်နဲ့ သော်ဒီဇင်လေးမှ ရေးသားထားပါတယ် 🤣🤣🤣
# 🕸🕷🕸🕸 Scrapy with Python 3.7.3 🐍

from scrapy.item import Field, Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from agent.items import AgentItem
from agent.helper import Helper
from scrapy.utils.markup import remove_tags

def rrm_tags(self, text):
    return remove_tags(text).replace("\n",' ')

class SampleItem(Item):
    link = Field()
    name = Field()
    brand = Field()
    price = Field()
    processor = Field() # (Generation and type) 
    ram = Field() #(Capacity)
    graphic = Field()
    display = Field()
    hdd = Field() #(Capacity and RPM)


class LinnSpider(CrawlSpider):
    name = "rs"
    allowed_domains = ["royalsmartmm.com"]
    start_urls = ["http://royalsmartmm.com/hp14-15/","http://royalsmartmm.com","http://royalsmartmm.com/hp-spectre-notebook-13-v114tu-i7/","http://royalsmartmm.com"]

    rules = (
        Rule(LinkExtractor(), callback='parse_page', follow=True), #deny_domains=["wp-content","sln-day", "category", "author","events","contact","officejet-pro","company-overview"]
    )

    def parse_page(self, response):
        item = SampleItem()
        #print(response.url)
        current_url = AgentItem.get_domain(self, response.url)
        # if current_url == 'https://www.sln-myanmar.com':
        #     #print("111111111111111111111111111111")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         #print("Hey, Here, It's me <<<<<<<<<<<<<<<<<<<<<<<<")
        #         item = AgentItem.lin_method(self, response, item)
        #         return item
            

        # if current_url == 'http://sln-myanmar.com/':
        #     print("2222222222222222222222222222222")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         #print("Hey, Here, It's me <<<<<<<<<<<<<<<<<<<<<<<<")
        #         item = AgentItem.sln_method(self, response, item)
        #         return item
        
        if current_url == 'http://royalsmartmm.com/':
            print("2")
            text = AgentItem.rm_tags(self, response.url)
            text_pass = AgentItem.chk_tfidf(self, text)
            
            if text_pass == True:
                #print("Hey, Here, It's me")
                item = AgentItem.royal_method(self, response, item)
                return item

                
        #return item
        