import Util

test_data = {'username': 'fde58e18177dbb0e1b19a91683c7188b'}

requrl = 'http://localhost:8001/heartway/public/index.php/user/getMyFriend'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/getMyFriend'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
