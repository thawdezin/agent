# -*- coding: utf-8 -*-
# ယခု Program လေးကိုတော့ဖြင့် Error ပေါင်း သောင်းခြောက်ထောင်နဲ့ သော်ဒီဇင်လေးမှ ရေးသားထားပါတယ် 🤣🤣🤣
# 🕸🕷🕸🕸 Scrapy with Python 3.7.3 🐍

from scrapy.item import Field, Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from agent.items import AgentItem
#from scrapy.utils.markup import remove_tags
from w3lib.html import remove_tags
import re

def rrm_tags(self, text):
    return remove_tags(text).replace("\n",' ')

class AllSpider(CrawlSpider):
    name = "rs"
    #allowed_domains = ["linnonlinestore.com","sln-myanmar.com","royalsmartmm.com"] #,"kmdshopping.com"]
    #start_urls = ["http://www.linnonlinestore.com/hp-15-cu0014tx-i5-laptop/","http://www.sln-myanmar.com/","http://www.royalsmartmm.com/"] #,"http://www.kmdshopping.com"

    allowed_domains = ["royalsmartmm.com"] #,"kmdshopping.com"]
    start_urls = ["http://www.royalsmartmm.com/"] #,"http://www.kmdshopping.com"

    rules = (
        #Rule(LinkExtractor(deny_domains=["store-tp0iths.mybigcommerce.com"]), callback='parse_page', follow=True),
        Rule(LinkExtractor(deny=[r'.*?setCurrencyId.*']), callback='parse_page', follow=True),
    )

    def parse_page(self, response):
        #response.replace(url='http://www.linnonlinestore.com/acer-aspire-e5-476-i3-laptop/')
        item = AgentItem()
        #AgentItem.del_log_file()
        #print(response.url)
        current_url = AgentItem.get_domain(self, response.url)
        # if current_url == 'http://www.linnonlinestore.com/':
        #     #print("111111111111111111111111111111")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         #print("Hey, Here, It's me <<<<<<<<<<<<<<<<<<<<<<<<")
        #         item = AgentItem.lin_method(self, response, item)
        #         return item

        # if current_url == 'http://www.kmdshopping.com/':
        #     #print("22222222222222222222222222222")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         item = AgentItem.kmd_method(self, response, item)
        #         return item
    
        # if current_url == 'http://sln-myanmar.com/':
        #     print("3333333333333333333333333333")
        #     text = AgentItem.rm_tags(self, response.url)
        #     text_pass = AgentItem.chk_tfidf(self, text)
            
        #     if text_pass == True:
        #         item = AgentItem.sln_method(self, response, item)
        #         return item
        
        if current_url == 'http://royalsmartmm.com/':
            print("11111111111111111111111111111111111")
            text = AgentItem.rm_tags(self, response.url)
            text_pass = AgentItem.chk_tfidf(self, text)
            
            if text_pass == True:
                item = AgentItem.royal_method(self, response, item)
                return item
            
        
        #return item