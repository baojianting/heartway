import Util

test_data = {'phone_number': '18792975133'}
requrl = 'http://localhost:8001/heartway/public/index.php/register/isRegistered'

# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/register/isRegistered'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
