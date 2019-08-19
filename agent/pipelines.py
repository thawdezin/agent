    
# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html


# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html
from twisted.enterprise import adbapi
import MySQLdb
import MySQLdb.cursors
import codecs
import json
from logging import log

class JsonWithEncodingPipeline(object):
    '''Save to the corresponding class in the file
        1, configured in the settings.py file
        2, in the self-implemented crawler class yield item, will be automatically executed'''    
    def __init__(self):
        self.file = codecs.open('Database.json', 'w', encoding='utf-8')#保存为json文件
    def process_item(self, item, spider):
        line = json.dumps(dict(item)) + "\n"#转为json的
        self.file.write(line)#写入文件中 ဖိုင်ထဲကို ရေး
        return item
    def spider_closed(self, spider):#爬虫结束时关闭文件 Crawlerရပ်တာနဲ့ ဖိုင်ကို ပိတ်
        self.file.close()

class AgentPipeline(object):
    '''保存到数据库中对应的class
       1、在settings.py文件中配置
       2、在自己实现的爬虫类中yield item,会自动执行
       Save to the corresponding class in the database
        1, configured in the settings.py file
        2, in the self-implemented crawler class yield item, will be automatically executed
       
       '''    

    def __init__(self,dbpool):
        self.dbpool=dbpool
        ''' 这里注释中采用写死在代码中的方式连接线程池，可以从settings配置文件中读取，更加灵活
        The comments here are written in the code to connect to the thread pool, 
        which can be read from the settings configuration file, which is more flexible.
            self.dbpool=adbapi.ConnectionPool('MySQLdb',
                                          host='127.0.0.1',
                                          db='crawlpicturesdb',
                                          user='root',
                                          passwd='123456',
                                          cursorclass=MySQLdb.cursors.DictCursor,
                                          charset='utf8',
                                          use_unicode=False)'''        
        
    @classmethod
    def from_settings(cls,settings):
        '''1、@classmethod声明一个类方法，而对于平常我们见到的则叫做实例方法。 
           2、类方法的第一个参数cls（class的缩写，指这个类本身），而实例方法的第一个参数是self，表示该类的一个实例
           3、可以通过类来调用，就像C.f()，相当于java中的静态方法
           
           1, @classmethod declares a class method, and for what we usually see is called an instance method.
           2, the first parameter of the class method cls (the abbreviation of class, refers to the class itself), 
                and the first parameter of the instance method is self, indicating an instance of the class
           3, can be called by the class, just like C.f (), equivalent to the static method in java
           
           '''
        dbparams=dict(
            host=settings['MYSQL_HOST'],#读取settings中的配置 設定で構成を読む
            db=settings['MYSQL_DBNAME'],
            user=settings['MYSQL_USER'],
            passwd=settings['MYSQL_PASSWD'],
            charset='utf8',#编码要加上，否则可能出现中文乱码问题The code is to be added,Otherwise, garbled problems may occur. ပါတဲ့ 🤯🤪🤪🤪🤪
            cursorclass=MySQLdb.cursors.DictCursor,
            use_unicode=False,
        )
        dbpool=adbapi.ConnectionPool('MySQLdb',**dbparams)
        #**表示将字典扩展为关键字参数,相当于host=xxx,db=yyy....
        #** indicates that the dictionary is expanded to a keyword parameter, which is equivalent to host=xxx, db=yyy....
        return cls(dbpool)
        #相当于dbpool付给了这个类，self中可以得到 #equivalent to dbpool paid to this class, you can get it in self

    #pipeline默认调用 ပိုက်လိုင်းဒတ်ဖော့ ခေါ်ပါတဲ့ WTF 😏 တစ်ကယ်က Pipline Default Call ပါ 😁😁😁
    def process_item(self, item, spider):
        query=self.dbpool.runInteraction(self._conditional_insert,item)#调用插入的方法 Call the insert method
        query.addErrback(self._handle_error,item,spider)#调用异常处理方法 Call exception handling
        return item
    
    #写入数据库中 Write to the database
    def _conditional_insert(self,tx,item):
        #print item['name']
        # sql="insert into lin(brand,display,graphic,hdd,link,name,price,processor,ram) values(%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        # params=(item["brand"],item["display"],item["graphic"],item["hdd"],item["link"],item["name"],item["price"],item["processor"],item["ram"])
        # tx.execute(sql,params)

        sql="insert into laptop(brand,display,graphic,hdd,link,name,price,processor,ram) values(%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        params=(item["brand"],item["display"],item["graphic"],item["hdd"],item["link"],item["name"],item["price"],item["processor"],item["ram"])

        # print("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA")
        # print(sql % params)
        # print("BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB")

        tx.execute(sql,params)
        
    
    #错误处理方法 Error handling method
    def _handle_error(self, failue, item, spider):
        pass
        # print('--------------database operation exception!!-----------------')
        # print('-------------------------------------------------------------')
        # print(failue)


class AgentRawPipeline(object):
    '''保存到数据库中对应的class
       1、在settings.py文件中配置
       2、在自己实现的爬虫类中yield item,会自动执行
       Save to the corresponding class in the database
        1, configured in the settings.py file
        2, in the self-implemented crawler class yield item, will be automatically executed
       
       '''    

    def __init__(self,dbpool):
        self.dbpool=dbpool
        ''' 这里注释中采用写死在代码中的方式连接线程池，可以从settings配置文件中读取，更加灵活
        The comments here are written in the code to connect to the thread pool, 
        which can be read from the settings configuration file, which is more flexible.
            self.dbpool=adbapi.ConnectionPool('MySQLdb',
                                          host='127.0.0.1',
                                          db='crawlpicturesdb',
                                          user='root',
                                          passwd='123456',
                                          cursorclass=MySQLdb.cursors.DictCursor,
                                          charset='utf8',
                                          use_unicode=False)'''        
        
    @classmethod
    def from_settings(cls,settings):
        '''1、@classmethod声明一个类方法，而对于平常我们见到的则叫做实例方法。 
           2、类方法的第一个参数cls（class的缩写，指这个类本身），而实例方法的第一个参数是self，表示该类的一个实例
           3、可以通过类来调用，就像C.f()，相当于java中的静态方法
           
           1, @classmethod declares a class method, and for what we usually see is called an instance method.
           2, the first parameter of the class method cls (the abbreviation of class, refers to the class itself), 
                and the first parameter of the instance method is self, indicating an instance of the class
           3, can be called by the class, just like C.f (), equivalent to the static method in java
           
           '''
        dbparams=dict(
            host=settings['MYSQL_HOST'],#读取settings中的配置 設定で構成を読む
            db=settings['MYSQL_DBNAME'],
            user=settings['MYSQL_USER'],
            passwd=settings['MYSQL_PASSWD'],
            charset='utf8',#编码要加上，否则可能出现中文乱码问题The code is to be added,Otherwise, garbled problems may occur. ပါတဲ့ 🤯🤪🤪🤪🤪
            cursorclass=MySQLdb.cursors.DictCursor,
            use_unicode=False,
        )
        dbpool=adbapi.ConnectionPool('MySQLdb',**dbparams)
        #**表示将字典扩展为关键字参数,相当于host=xxx,db=yyy....
        #** indicates that the dictionary is expanded to a keyword parameter, which is equivalent to host=xxx, db=yyy....
        return cls(dbpool)
        #相当于dbpool付给了这个类，self中可以得到 #equivalent to dbpool paid to this class, you can get it in self

    #pipeline默认调用 ပိုက်လိုင်းဒတ်ဖော့ ခေါ်ပါတဲ့ WTF 😏 တစ်ကယ်က Pipline Default Call ပါ 😁😁😁
    def process_item(self, item, spider):
        query=self.dbpool.runInteraction(self._conditional_insert,item)#调用插入的方法 Call the insert method
        query.addErrback(self._handle_error,item,spider)#调用异常处理方法 Call exception handling
        return item
    
    #写入数据库中 Write to the database
    def _conditional_insert(self,tx,item):
        #print item['name']
        # sql="insert into lin(brand,display,graphic,hdd,link,name,price,processor,ram) values(%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        # params=(item["brand"],item["display"],item["graphic"],item["hdd"],item["link"],item["name"],item["price"],item["processor"],item["ram"])
        # tx.execute(sql,params)

        #AgentRawPipeline
        sql="insert into step(brand,display,graphic,hdd,link,name,price,processor,ram,body,tags,body_w) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        params=(item["brand"],item["display"],item["graphic"],item["hdd"],item["link"],item["name"],item["price"],item["processor"],item["ram"],item["body"],item["tags"],item["body_w"])
        # print("*************************************")
        # print(sql % params)
        # print("*************************************")
        tx.execute(sql,params)
    
    #错误处理方法 Error handling method
    def _handle_error(self, failue, item, spider):
        pass
        # print('--------------database operation exception!!-----------------')
        # print('-------------------------------------------------------------')
        # print(type(failue))
