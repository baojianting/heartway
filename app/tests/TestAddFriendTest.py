import Util

test_data = {'my_username': '0e7ee19dfa912be9cfed9d775a049950', 'your_username': '847befa0535ac4fdbff57e78b1d8638f'}

requrl = 'http://localhost:8001/heartway/public/index.php/user/add'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/add'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
 
