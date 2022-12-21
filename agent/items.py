# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy
# from scrapy.utils.markup import remove_tags
from w3lib.html import remove_tags
from urllib.parse import urlparse
import datetime
import time
import math
import os
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
from scrapy.item import Field, Item

class AgentItem(scrapy.Item):
    link = Field()
    name = Field()
    brand = Field()
    price = Field()
    processor = Field() # (Generation and type) 
    ram = Field() #(Capacity)
    graphic = Field()
    display = Field()
    hdd = Field() #(Capacity and RPM)

    body = Field()
    tags = Field()
    body_w = Field()
    tags_w = Field()

    # define the fields for your item here like:
    # name = scrapy.Field()
    def get_domain(self, res_url):
        parsed_uri = urlparse(res_url)
        domain = '{uri.scheme}://{uri.netloc}/'.format(uri=parsed_uri)
        return domain
    
    def del_log_file():

        dir_name = "C:\\Users\\thawd\\thesis\\agent"
        all_file = os.listdir(dir_name)

        for item in all_file:
            if item.endswith(".log"):
                os.remove(os.path.join(dir_name, item))

    def rm_tags(self, text):
        return remove_tags(text).replace("\n",' ')
  
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    def lin_method(self, resp, input_item):
        #lst = ['Gaming','Notebook', 'HP','Laptop','Acer','Aspire','Lenovo','Thinkpad','ideapad','Dell','Inspiron','ASUS',]
        item_quantity = resp.css('#qty_').extract()
        title_list = resp.css('.title::text').extract()
        title_string = ''.join(str(e) for e in title_list)
        item_title = title_string #"DELL INSPIRON 15 3581 (I3)"
        item_title = item_title.lower()
        word = ["Gaming","Notebook", "HP","Laptop","Acer","Aspire","Lenovo","Thinkpad","ideapad","Dell","Inspiron","ASUS"]
        count = 0
        for wo in word:
            wo = wo.lower()
            if wo in item_title:
                count += 1
                #အိပ်ချင်တယ် ခေါင်းကိုက်တယ် 😭😭😭

        if "desktop" in item_title or "Desktop" in item_title or "PC" in item_title:
            count = 0 # Desktop ဖြစ်နေရင် မယူပါ
        

        if item_quantity is not None and count > 1:
            haha = 0
            input_item['link'] = resp.url
            input_item['name'] = item_title # OK for title

            haha = haha + 2
            #__________________________________________________________________________________
            #__________________________________________________________________________________
            item_price_list = resp.css(".VariationProductPrice::text").extract()
            for item_price in item_price_list:
                if "Ks" in item_price or "ks" in item_price:
                    item_price = item_price.replace("Ks",'')
                    item_price = item_price.replace(",",'')
                    #item_price = float(item_price)
                    input_item['price'] = item_price
                    haha += 1
                if "$" in item_price:
                    item_price = item_price.replace("$",'')
                    item_price = item_price.replace(",",'')
                    #item_price = float(item_price)
                    #print(type(item_price)," <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ")
                    #item_price = item_price * 1525
                    input_item['price'] = item_price
                    haha += 1
            #__________________________________________________________________________________
            brand_title = item_title
            brand_list = ["HP","ASUS","Lenovo","Acer","HP","MSI","Dell"]
            for brand_count in brand_list:
                brand_title = brand_title.lower()
                brand_count = brand_count.lower()
                if brand_count in brand_title:
                    input_item['brand'] = brand_count #OK for brand
                    haha += 1
            #__________________________________________________________________________________
            #__________________________________________________________________________________
            span_list = resp.css("span::text").extract() #["7th Intel Core i3-7020U (2.3GHz)", "Gaming","Notebook", "HP","Laptop","Acer","Aspire","Lenovo","Thinkpad","ideapad","Dell","Inspiron","ASUS"]
            for span_item in span_list:
                span_item = span_item.replace('-','')
                span_item = span_item.strip()
                if "Ryzen" in span_item or "Core" in span_item:
                    temp_spec = span_item[:span_item.index("th")]
                    temp_spec = temp_spec.strip()
                    temp_spec += "th Generation Intel Core"
                    span_item.replace('™','')
                    span_item.replace('®','')
                    temp_spec += span_item[span_item.index("Core")+len("Core"):span_item.index("Core")+len("Core")+3]
                    temp_spec.replace("- ",'')
                    temp_spec.replace("™",'')
                    temp_spec.replace("Core™",'Core')
                    input_item['processor'] = temp_spec #OK for processor
                    haha += 1
                    temp_spec = None
                if "DDR3" in span_item or "DDR4" in span_item:
                    temp_spec = span_item[:span_item.index("GB")]
                    temp_spec.replace(" ",'')
                    temp_spec = "".join(temp_spec.split())
                    input_item['ram'] = temp_spec #OK for ram
                    haha += 1
                if "Graphic" in span_item or "Nvidia" in span_item or "Radeom" in span_item  or "AMD Radeon" in span_item:
                    input_item['graphic'] = span_item #OK for Graphic
                    haha += 1
                if "Display" in span_item or "LCD" in span_item or "Anti-Glare" in span_item or "diagonal" in span_item or "Diagonal" in span_item:
                    span_item.replace("'",'')
                    span_item.replace('"','')
                    input_item['display'] = span_item #OK for display
                    haha += 1
                if "HDD" in span_item or "SSD" in span_item:
                    hdd_find = span_item.split(" ")
                    for hdd_count in hdd_find:
                        if "GB" in hdd_count:
                            hdd_count = hdd_count.replace("(",'')
                            hdd_count = hdd_count.replace(")",'')
                            hdd_count = hdd_count.replace("GB",'')
                            hdd_count = hdd_count.replace(" ",'')
                            if not hdd_count.isdigit():
                                hdd_count = 512
                            hdd_count = float(hdd_count)
                            if hdd_count > 255:
                                input_item['hdd'] = hdd_count #OK for hdd
                                haha += 1
                            hdd_count = None
                            hdd_count = str(hdd_count)
                        if "TB" in hdd_count:
                            hdd_count = hdd_count.replace("TB",'')
                            hdd_count = int(hdd_count)
                            hdd_count *= 1024
                            input_item['hdd'] = hdd_count #OK for hdd
                            haha += 1
            resp_body_decode = resp.body
            input_item['body'] = resp_body_decode.decode("utf-8") 
            resp_tags = resp.css("span").extract()
            resp_tags = ''.join(str(e) for e in resp_tags)
            input_item['tags'] =  resp_tags
            tmp_resp_body = resp.body
            input_item['body_w'] = remove_tags(tmp_resp_body).replace("\n",' ')
            #input_item['tags_w'] = resp.css("span::text").extract()
            #print("Test: ", input_item['tags'])
            #__________________________________________________________________________________
            print("LINNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN Start")
            print("Brand: ",input_item['brand'])
            print("Display: ",input_item['display'])
            print("Graphic: ",input_item['graphic'])
            print("HDD: ",input_item['hdd'])            
            print("Link: ",input_item['link'])
            print("Name: ",input_item['name'])
            print("Price: ",input_item['price'])
            print("Processor: ",input_item['processor'])
            print("HaHa Count Inner Loop", haha)
            print("LINNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN End")
            return input_item
        #time.sleep(5)
   
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def kmd_method(self, resp, input_item):
        lst = ['Acer', 'Swift', 'Aspire', 'Core', 'i5', 'i7', 'i9', 'Gaming', 'Raider', 'Stealth', 'RTX', 'GTX'] # Pen is Desktop version
         
        return input_item
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def sln_method(self, resp, input_item):
        #lst = ['Acer', 'Swift', 'Aspire', 'Core', 'i5', 'i7', 'i9', 'Gaming', 'Raider', 'Stealth', 'RTX', 'GTX'] # Pen is Desktop version
        #print("I am in sln_method")
        sln_header = resp.css(".title-subheader::text")[0].extract()
        sln_header = ''.join(str(e) for e in sln_header)
        sln_header = sln_header.replace("\r",'')
        sln_header = sln_header.replace("\n",'')
        sln_header = sln_header.strip()
        #print(sln_header)

        title_list = resp.css('.current-item::text').extract()
        title_string = ''.join(str(e) for e in title_list)
        item_title = title_string #"DELL INSPIRON 15 3581 (I3)"
        item_title = item_title.lower()
        word = ["Gaming","Notebook", "HP","Laptop","Acer","Aspire","Swift","i3","i5","i7","Core","Stealth","Raider","(Gaming)"]
        count = 0
        for wo in word:
            wo = wo.lower()
            if wo in item_title:
                count += 1
                #အိပ်ချင်တယ် ခေါင်းကိုက်တယ် 😭😭😭

        if "tc" in item_title or "xc" in item_title or "(pen)" in item_title:
            #print("Desktop")
            count = 0

        if sln_header == "Blog Single" and count > 1:
            haha = 0
            #print("Count is greater than 1 and Count iBBBBBBBB ")
            #print("2222222222222222222222222222222222222222222222222222222")
            input_item['link'] = resp.url
            input_item['name'] = item_title # OK for title
            if "acer" in item_title:
                input_item['brand'] = "Acer"
            #__________________________________________________________________________________
            sln_item_detail = resp.css("li::text").extract()
            for sln_detail in sln_item_detail:
                sln_detail_lower = sln_detail.lower()
                #print("111111111111111111111111111111111111111111111111111")
                if "processor" in sln_detail_lower:
                    input_item['processor'] = sln_detail
                    #print("Keep trying ")
                    haha += 1
                
                if "ddr4" in sln_detail_lower or "ddr3" in sln_detail_lower:
                    input_item['ram'] = sln_detail
                    haha += 1
                
                if "nvidia" in sln_detail_lower or "geforce" in sln_detail_lower or "rtx" in sln_detail_lower or "gtx" in sln_detail_lower or "radeon" in sln_detail_lower or "amd radeon" in sln_detail_lower:
                    input_item['graphic'] = sln_detail
                    haha += 1
                
                if "high-resolutoin" in sln_detail_lower or "resolution" in sln_detail_lower or "display" in sln_detail_lower:
                    input_item['display'] = sln_detail
                    haha += 1

                if "ssd" in sln_detail_lower or "hdd" in sln_detail_lower:
                    input_item['hdd'] = sln_detail
                    haha += 1
                
                if haha < 3:
                    sln_item_at_p = resp.css("p::text").extract()
                    sln_item_at_p_lower = sln_item_at_p.lower()
                    for sln_para in sln_item_at_p_lower:
                        if "processor" in sln_para or "hdd" in sln_para or "nvidia" in sln_para or "ddr4" in sln_para:
                            for sln_detail in sln_item_at_p:
                                #print("Gold bro gold gold hahahahhahahhahahah 🤣")
                                sln_detail_lower = sln_detail.lower()
                                if "processor" in sln_detail_lower:
                                    input_item['processor'] = sln_detail
                                
                                
                                if "ddr4" in sln_detail_lower or "ddr3" in sln_detail_lower:
                                    input_item['ram'] = sln_detail
                                    
                                
                                if "nvidia" in sln_detail_lower or "geforce" in sln_detail_lower or "rtx" in sln_detail_lower or "gtx" in sln_detail_lower or "radeon" in sln_detail_lower:
                                    input_item['graphic'] = sln_detail
                                    
                                
                                if "high-resolutoin" in sln_detail_lower or "resolution" in sln_detail_lower or "display" in sln_detail_lower:
                                    input_item['display'] = sln_detail
                                    

                                if "ssd" in sln_detail_lower or "hdd" in sln_detail_lower:
                                    input_item['hdd'] = sln_detail                        
            #__________________________________________________________________________________
            #__________________________________________________________________________________
            #__________________________________________________________________________________
            return input_item
        #print(datetime.datetime.now())
            #print("")
        
        print("SLNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN Start")
        print("Brand: ",input_item['brand'])
        print("Display: ",input_item['display'])
        print("Graphic: ",input_item['graphic'])
        print("HDD: ",input_item['hdd'])            
        print("Link: ",input_item['link'])
        print("Name: ",input_item['name'])
        print("Price: ",input_item['price'])
        print("Processor: ",input_item['processor'])
        print("SLNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN End")
        return input_item


    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def techno_method(self, resp, input_item):
        lst = ['Acer', 'Swift', 'Aspire', 'Core', 'i5', 'i7', 'i9', 'Gaming', 'Raider', 'Stealth', 'RTX', 'GTX'] # Pen is Desktop version
         
        return input_item

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def royal_method(self, resp, input_item):
        rs_page_entry = resp.css(".entry-title::text").extract()
        rs_li = resp.css("li::text").extract()
        #print("22222222222222222222222222222222222222")
        
        rs_page_list = resp.css("strong::text").extract()
        for rs_page_ in rs_page_list:
            rs_page_ = rs_page_.lower()
            #print(resp.url)
            if "product specification" in rs_page_:
                
                #print("33333333333333333333333333333333333333333333333333333333333333333333333333")
                input_item['name'] = rs_page_entry
                input_item['link'] = resp.url
                input_item['brand'] = "HP"
                
                for every_li in rs_li:
                    if "Intel Core" in every_li or "Ryzen" in every_li:
                        rs_processor = every_li[0]
                        rs_processor += "th Generation Intel Core "
                        rs_processor += every_li[every_li.index("Intel Core")+len("Intel Core")+1:every_li.index("Intel Core")+len("Intel Core")+3]
                        input_item['processor'] = rs_processor
                        #print(rs_processor)
                    
                    if "diagonal" in every_li or "Diagonal" in every_li:
                        input_item['display'] = every_li

                    if "USD" in every_li or "$" in every_li or "Price" in every_li:
                        rs_price = every_li.replace("USD",'')
                        rs_price = rs_price.replace("$",'')
                        rs_price = rs_price.replace(" ",'')
                        rs_price = rs_price.replace("-",'')
                        rs_price = rs_price.replace(":",'')
                        rs_price = rs_price.replace("Price",'')
                        if not rs_price.isdigit():
                            input_item['price'] = rs_price
                        else:
                            rs_price = rs_price * 1525
                            input_item['price'] = rs_price
                    
                    if "DDR4" in every_li or "DDR3" in every_li or "SSD" in every_li or "HDD" in every_li:
                        ram = every_li[:2]
                        #print("ram is ", ram)
                        input_item['ram'] = ram
                        every_li = every_li[2:]
                        #print(every_li, " is latest")
                        start_hdd_point = every_li.index("TB") - 2
                        rs_hdd = every_li[start_hdd_point:every_li.index("TB")]
                        rs_hdd = float(rs_hdd)
                        if rs_hdd < 1:
                            rs_hdd = 500
                        input_item['hdd'] = int(rs_hdd * 1024)
                    
                    if "Radeon" in every_li or "Nvidia" in every_li or "NVIDIA" in every_li:
                        input_item['graphic'] = every_li
                
                #print("444444444444444444444444444444444444444444444444444444444444444444")
            if "Price" in rs_page_ and rs_page_entry is not None: 
                rs_price = rs_page_
                rs_price = rs_price.replace("Price",'')
                rs_price = rs_price.replace("USD",'')
                rs_price = rs_price.replace(":",'')
                rs_price = rs_price.replace(" ",'')
                input_item['price'] = rs_price
        
        print("RSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS Start")
        print("Brand: ",input_item['brand'])
        print("Display: ",input_item['display'])
        print("Graphic: ",input_item['graphic'])
        print("HDD: ",input_item['hdd'])            
        print("Link: ",input_item['link'])
        print("Name: ",input_item['name'])
        print("Price: ",input_item['price'])
        print("Processor: ",input_item['processor'])
        print("RSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS End")
        return input_item

    #####################################################
    #Future work for more Website နောက်ပိုင်း တိုးလာမဲ့ Website များအတွက် ဆက်ရေးရန်
    #def websiteName_method(self, resp, input_item):
    #   return input_item
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def toscrape_method(self, resp, input_item):
        print("Hey, here me, OKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK")
        return input_item
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    def chk_tfidf(self, text):
        base_laptop_term = "laptop laptop laptop acer dell msi hp asus lenovo nvidia intel core radeon"
        webpage_input = text

        webpage_input = remove_tags(webpage_input).replace("\n",' ')

        webpage_input = webpage_input.lower()
        webpage_input = webpage_input.strip()
        webpage_input = webpage_input.replace("{","")
        webpage_input = webpage_input.replace("}","")
        webpage_input = webpage_input.replace("/","")
        webpage_input = webpage_input.replace(";","")
        webpage_input = webpage_input.replace("'","")
        webpage_input = webpage_input.replace(":","")
        webpage_input = webpage_input.replace(";","")
        webpage_input = webpage_input.replace("(","")
        webpage_input = webpage_input.replace(")","")
        webpage_input = webpage_input.replace(",","")
        webpage_input = webpage_input.replace("#","")
        webpage_input = webpage_input.replace("$","")


        documents = (base_laptop_term,webpage_input)

        tfidf_vectorizer = TfidfVectorizer()
        tfidf_matrix = tfidf_vectorizer.fit_transform(documents)
        cos_s = cosine_similarity(tfidf_matrix[0:1], tfidf_matrix)

        actual_value = float(cos_s.flat[1])
        #print("Value for cosine similarity ", actual_value)

        # This was already calculated on the previous step, so we just use the value
        cos_sim = actual_value
        angle_in_radians = math.acos(cos_sim)
        final_decision_tfidf_check = math.degrees(angle_in_radians)

        if final_decision_tfidf_check > 90:
            return False
        else:
            return True
        # return True  
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
        
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
        
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
        
    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################

    ##############################################################################################################
    ##############################################################################################################
    ##############################################################################################################
    
