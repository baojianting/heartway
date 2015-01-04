import Util

test_data = {'route_area_id': '1'}
requrl = 'http://localhost:8001/heartway/public/index.php/rankinglist/routeOfArea'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/rankinglist/routeOfArea'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
