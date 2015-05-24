import random
from mechanize import Browser
import threading

def randomname():
    alph = 'abcdefghijklmnopqrstuvwxyz'
    x = ''
    for a in range(0,8):
        x+=random.choice(alph)
    return x

filex = raw_input("File to save the accounts into: ")


def create():
    while 1:
        try:
            br = Browser()
            br.set_handle_robots(False)
            br.addheaders = [('User-agent', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1) Gecko/2008071615 Fedora/3.0.1-1.fc9 Firefox/3.0.1')]
            br.open('https://classic.netaddress.com/tpl/Subscribe/Step1?Locale=en&AdInfo=&Referer=http%3A%2F%2Fwww.netaddress.com%2F&T=1332304112864372')
            br.select_form(name='Step1')
            userid = randomname()
            br.form['usrUserId'] = userid
            pwd = randomname()
            br.form['newPasswd'] = pwd
            br.form['RPasswd'] = pwd
            br.form['usrFirst'] = randomname()
            br.form['usrLast'] = randomname()
            br.form['usrTimeZone'] = ['Africa/Abidjan']
            br.form['usrCn'] = ['AF']
            br.submit()
            print "Created " + userid + " with password " + pwd
            filo = open(filex, 'a')
            filo.write(userid + "@usa.net" + ":" + pwd + "\n")
            filo.close()

        except:
            print "error"

x = 1
nbthreads = input("Number of threads: ")
while x<=nbthreads:
    try:
        threading.Thread(target=create).start()
        print "Thread number " + str(x) + " started"
        x+=1
    except:
        x+=1


while 1:
    pass
