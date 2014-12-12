import Util

test_data = {'phone_number': '13772894675', 'password': 'e10adc3949ba59abbe56e057f20f883e'}

requrl = 'http://localhost:8001/heartway/public/index.php/login'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/login'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
