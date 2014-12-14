import Util

test_data = {'my_phone_number': 'hehe1', 'your_phone_number': 'sads'}

# requrl = 'http://localhost:8001/heartway/public/index.php/user/add'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/add'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res

