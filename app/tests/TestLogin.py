import Util

test_data = {'phone_number': '22', 'password': '234'}

# requrl = 'http://localhost:8001/heartway/public/index.php/login'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/login'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
