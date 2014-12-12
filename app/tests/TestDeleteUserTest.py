import Util

test_data = {'user_name': '18192375514'}

# requrl = 'http://localhost:8001/heartway/public/index.php/delete/user'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/delete/user'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
