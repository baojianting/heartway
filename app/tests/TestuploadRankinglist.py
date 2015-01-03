import Util

test_data = {'route_id': '13', 'user_id': '1401', 'average_speed': '10', 'route_points': 'asd'}
requrl = 'http://localhost:8001/heartway/public/index.php/rankinglist/upload'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/rankinglist/upload'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
