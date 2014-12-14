import Util

test_data = {'phone_number': 'hehe1'}

# requrl = 'http://localhost:8001/heartway/public/index.php/user/find'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/find'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
