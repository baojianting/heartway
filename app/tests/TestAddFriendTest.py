import Util

test_data = {'my_phone_number': 'cc0be51d25be7aa87b2fd31f9c9a80f0', 'your_phone_number': '1341b611af4820a6287e7bd2bd3d6b94'}

requrl = 'http://localhost:8001/heartway/public/index.php/user/add'
# requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/add'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
