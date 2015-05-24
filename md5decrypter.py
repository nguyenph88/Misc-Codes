import BeautifulSoup,threading

def chunkIt(seq, num):
    avg = len(seq) / float(num)
    out = []
    last = 0.0
    while last < len(seq):
        out.append(seq[int(last):int(last + avg)])
        last += avg
    return out

def crack(md5list, filex):
    for passing in md5list:
        try:
            if passing.endswith('\n'):
                passing = passing[:-1]
            email, mhash = passing.split(':')
            br = __import__('mechanize').Browser()
            br.open('http://www.md5.rednoize.com')
            br.select_form(nr=0)
            br.form['q'] = mhash
            br.submit()
            soup = BeautifulSoup.BeautifulSoup(br.response().read())
            for a in soup.findAll('div'):
                try:
                    if a['id'] == 'result':
                        if a.string:
                            print "Cracked " + mhash + " = " + a.string
                            opend = open(filex,'a')
                            opend.write(email+":"+a.string+'\n')
                            opend.close()
                except:
                    pass
        except:
            print "error with " + passing






mhash= open(raw_input('File with md5 :')).readlines()
filex = raw_input("File to save the cracked md5 into: ")
nbthreads = input("Number of threads ")
if len(mhash) >= nbthreads:
        z = chunkIt(mhash, nbthreads)
        for passz in z:
            threading.Thread(target=crack, args=(passz,filex)).start()
else:
    z = chunkIt(mhash, len(mhash))
    for passz in z:
            threading.Thread(target=crack, args=(passz,filex)).start()
