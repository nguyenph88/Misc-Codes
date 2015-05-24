from selenium import webdriver
import names
from selenium.webdriver.common.proxy import *

myProxy = "117.10.244.186:8118"

proxy = Proxy({
    'proxyType': ProxyType.MANUAL,
    'httpProxy': myProxy,
    'ftpProxy': myProxy,
    'sslProxy': myProxy,
    'noProxy': '' # set this value as desired
    })

name = names.get_first_name() + names.get_last_name()
email = name + "@yopmail.com"
url = "http://mailinator.com/inbox.jsp?to=" + name
driver = webdriver.Firefox(proxy=proxy)
driver.get("http://www.cyberghostvpn.com/en_us/campaign/windeal_jan15")
element = driver.find_element_by_id("mail_text_field")
element.send_keys(name)

element = driver.find_element_by_id("Submit")
element.click()


#driver.get(url)


