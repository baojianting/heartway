import Util

test_data = {'route_id': '13', 'page_num': '10'}
requrl = 'http://localhost:8001/heartway/public/index.php/rankinglist/getRankinglistOfRoute'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/rankinglist/getRankinglistOfRoute'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
