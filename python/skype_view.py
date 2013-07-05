#!/usr/bin/python

import Skype4Py

client = Skype4Py.Skype(Transport='x11')
client.Attach()

for user in client.Friends:
	print '	', user.FullName

