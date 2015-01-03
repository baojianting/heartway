import Util

test_data = {'username': '0e7ee19dfa912be9cfed9d775a049950','signature': 'you yuiuyiarerty handsome'}
#test_data = {'username': '0e7ee19dfa912be9cfed9d775a049950', 'password': '123', 'avatar': 'asdasd', 'signature': 'you are handsome'}
#test_data = {'username': '0e7ee19dfa912be9cfed9d775a049950', 'password': '123', 'avatar': 'asdasd', 'signature': 'you are handsome'}
#test_data = {'username': '0e7ee19dfa912be9cfed9d775a049950', 'password': '123', 'avatar': 'asdasd', 'signature': 'you are handsome'}
#test_data = {'username': '0e7ee19dfa912be9cfed9d775a049950', 'password': '123', 'avatar': 'asdasd', 'signature': 'you are handsome'}

# requrl = 'http://localhost:8001/heartway/public/index.php/user/modify'
requrl = 'http://120.27.40.13:8001/heartway/public/index.php/user/modify'

ut = Util.Util()

res = ut.post_method(requrl, test_data)

print res
