import Util

test_data = {'my_username': '1f9c26b6c7169a84daaee90eb98c012d', 'your_username': 'b031dae35b41001a0cca7de5a6ff4c5e'}

# requrl = 'http://localhost:8001/heartway/public/index.php/user/add'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/add'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
 
