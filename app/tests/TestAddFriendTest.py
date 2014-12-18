import Util

test_data = {'my_username': '847befa0535ac4fdbff57e78b1d8638f', 'your_username': 'd3289079833148edb616b0c3c1189811'}

requrl = 'http://localhost:8001/heartway/public/index.php/user/add'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/add'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
 
