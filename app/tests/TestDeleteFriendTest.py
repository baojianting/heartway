import Util

test_data = {'myUserName': '18192375514', 'yourUserName': '12321'}

requrl = 'http://localhost:8001/heartway/public/index.php/user/deleteFriend'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/deleteFriend'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
