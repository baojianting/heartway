import urllib
import urllib2

test_data = {'phone_number': '18792975133'}
test_data_urlencode = urllib.urlencode(test_data)

requrl = 'http://localhost:8001/heartway/public/index.php/register/isRegistered'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/register/isRegistered'

req = urllib2.Request(url=requrl, data=test_data_urlencode)
print req

res_data = urllib2.urlopen(req)
res = res_data.read()

print res
