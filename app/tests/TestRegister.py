import Util

test_data = {'phone_number': 'baotest2', 'password': '1234'}

# requrl = 'http://localhost:8001/heartway/public/index.php/register/register'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/register/register'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
