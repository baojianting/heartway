import urllib
import urllib2

class Util(object):

    def __init__(self):
        pass
    
    def post_method(self, url, data):
        test_data_urlencode = urllib.urlencode(data)
        req = urllib2.Request(url=url, data=test_data_urlencode)
        res_data = urllib2.urlopen(req)
        res = res_data.read()
        return res
