import Util

test_data = {}
requrl = 'http://localhost:8001/heartway/public/index.php/rankinglist/routeArea'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/rankinglist/routeArea'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
