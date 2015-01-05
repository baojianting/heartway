import Util

test_data = {'route_id': '5', 'username': 'cc0be51d25be7aa87b2fd31f9c9a80f0', 'average_speed': '10', 'route_points': '(116.308529,39.668941),(116.753475,39.711211),(117.094052,39.643566),(116.649105,39.486883),(116.220639,39.558917)', 'total_time': '12:12:12'}
requrl = 'http://localhost:8001/heartway/public/index.php/rankinglist/upload'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/rankinglist/upload'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
