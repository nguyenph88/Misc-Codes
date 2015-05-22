from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from GoogleAliases import GoogleAliases
import names, random

ga = GoogleAliases("leninnguyen12")
aliases = ga.get_aliases()

for user in aliases:
	username = user + "@gmail.com"
	profile = webdriver.FirefoxProfile()
	profile.set_preference("general.useragent.override","Mozilla/4.0 (compatible; MSIE 7.0; America Online Browser 1.1; Windows NT 5.1; (R1 1.5); .NET CLR 2.0.50727; InfoPath.1)")
	driver=webdriver.Firefox(profile)
	driver.set_window_size(1, 1)
	driver.set_window_position(-2000, 0)
	#driver = webdriver.PhantomJS("./phantomjs.exe")
	print "Register Email: " + username
	driver.get("https://geoauth.google.com/gev0/free_trial.html")


	#element = driver.find_element_by_name("userName")
	element = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.NAME, "userName")))
	element.send_keys(username)

	element = driver.find_element_by_name("confirmUserName")
	element.send_keys(username)

	element = driver.find_element_by_name("firstName")
	element.send_keys(names.get_first_name())

	element = driver.find_element_by_name("lastName")
	element.send_keys(names.get_last_name())

	element = driver.find_element_by_name("company")
	element.send_keys(names.get_full_name())

	element = driver.find_element_by_name("title")
	element.send_keys("Software Engineer")

	element = driver.find_element_by_name("businessPhone")
	element.send_keys("510" + str(random.randint(1000000,9999999)))

	driver.find_element_by_xpath("//select[@name='country']/option[text()='United States']").click()

	driver.find_element_by_xpath("//select[@name='industry']/option[@value='3']").click()

	driver.find_element_by_xpath("//select[@name='employees']/option[@value='2']").click()

	element.submit()
	source = driver.page_source

	while "User Already Signed Up" not in source:
		print "Refreshing ..."
		source = driver.page_source
		driver.refresh()
		alert = driver.switch_to_alert()
		alert.accept()

	driver.quit()
