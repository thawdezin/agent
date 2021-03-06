# -*- coding: utf-8 -*-

# Scrapy settings for agent project
#
# For simplicity, this file contains only settings considered important or
# commonly used. You can find more settings consulting the documentation:
#
#     https://doc.scrapy.org/en/latest/topics/settings.html
#     https://doc.scrapy.org/en/latest/topics/downloader-middleware.html
#     https://doc.scrapy.org/en/latest/topics/spider-middleware.html

BOT_NAME = '^_^ Goblok ^_^'

SPIDER_MODULES = ['agent.spiders']
NEWSPIDER_MODULE = 'agent.spiders'


# Crawl responsibly by identifying yourself (and your website) on the user-agent
USER_AGENT = 'UTYCC Student from Myanmar(Burma)'# +959797990911 www.facebook.com/thawdezin' #'agent (+http://www.yourdomain.com)'

# Obey robots.txt rules
ROBOTSTXT_OBEY = False

# Configure maximum concurrent requests performed by Scrapy (default: 16)
CONCURRENT_REQUESTS = 256

# Configure a delay for requests for the same website (default: 0)
# See https://doc.scrapy.org/en/latest/topics/settings.html#download-delay
# See also autothrottle settings and docs
#DOWNLOAD_DELAY = 3
# The download delay setting will honor only one of:
#CONCURRENT_REQUESTS_PER_DOMAIN = 16
#CONCURRENT_REQUESTS_PER_IP = 16

# Disable cookies (enabled by default)
#COOKIES_ENABLED = False

# Disable Telnet Console (enabled by default)
#TELNETCONSOLE_ENABLED = False

# Override the default request headers:
#DEFAULT_REQUEST_HEADERS = {
#   'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
#   'Accept-Language': 'en',
#}

# Enable or disable spider middlewares
# See https://doc.scrapy.org/en/latest/topics/spider-middleware.html
#SPIDER_MIDDLEWARES = {
#    'agent.middlewares.AgentSpiderMiddleware': 543,
#}

# Enable or disable downloader middlewares
# See https://doc.scrapy.org/en/latest/topics/downloader-middleware.html
#DOWNLOADER_MIDDLEWARES = {
#    'agent.middlewares.AgentDownloaderMiddleware': 543,
#}

# Enable or disable extensions
# See https://doc.scrapy.org/en/latest/topics/extensions.html
#EXTENSIONS = {
#    'scrapy.extensions.telnet.TelnetConsole': None,
#}

# Configure item pipelines
# See https://doc.scrapy.org/en/latest/topics/item-pipeline.html
#ITEM_PIPELINES = {
#    'agent.pipelines.AgentPipeline': 300,
#}

# Enable and configure the AutoThrottle extension (disabled by default)
# See https://doc.scrapy.org/en/latest/topics/autothrottle.html
#AUTOTHROTTLE_ENABLED = True
# The initial download delay
#AUTOTHROTTLE_START_DELAY = 5
# The maximum download delay to be set in case of high latencies
#AUTOTHROTTLE_MAX_DELAY = 60
# The average number of requests Scrapy should be sending in parallel to
# each remote server
#AUTOTHROTTLE_TARGET_CONCURRENCY = 1.0
# Enable showing throttling stats for every response received:
#AUTOTHROTTLE_DEBUG = False

# Enable and configure HTTP caching (disabled by default)
# See https://doc.scrapy.org/en/latest/topics/downloader-middleware.html#httpcache-middleware-settings
#HTTPCACHE_ENABLED = True
#HTTPCACHE_EXPIRATION_SECS = 0
#HTTPCACHE_DIR = 'httpcache'
#HTTPCACHE_IGNORE_HTTP_CODES = []
#HTTPCACHE_STORAGE = 'scrapy.extensions.httpcache.FilesystemCacheStorage'

#########################################################################
#Custom settings by Thaw De Zin
#########################################################################

#Currently Scrapy does DNS resolution in a blocking way with usage of thread pool. 
# With higher concurrency levels the crawling could be slow or even fail hitting DNS resolver timeouts. 
# Possible solution to increase the number of threads handling DNS queries. 
# The DNS queue will be processed faster speeding up establishing of connection and crawling overall.

#To increase maximum thread pool size use:
REACTOR_THREADPOOL_MAXSIZE = 20

#Retrying failed HTTP requests can slow down the crawls substantially, 
# specially when sites causes are very slow (or fail) to respond,
# thus causing a timeout error which gets retried many times, 
# unnecessarily, preventing crawler capacity to be reused for other domains.

#To disable retries use:

# RETRY_ENABLED = True

ITEM_PIPELINES = {
    'agent.pipelines.AgentPipeline': 300,#mysql အဖြစ် သိမ်း
    #'agent.pipelines.JsonWithEncodingPipeline': 300,#ဖိုင်အဖြစ် သိမ်း
    'agent.pipelines.AgentRawPipeline': 300,# အခြေအနေသိရဖို့
}
 
#Mysql数据库的配置信息
MYSQL_HOST = '127.0.0.1'
MYSQL_DBNAME = 'agent'         #数据库名字，请修改
MYSQL_USER = 'root'             #数据库账号，请修改 
MYSQL_PASSWD = 'dede'         #数据库密码，请修改

MYSQL_PORT = 3306               #数据库端口，在dbhelper中使用

