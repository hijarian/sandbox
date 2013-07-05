#!/usr/bin/python

import Skype4Py
import sys

client = Skype4Py.Skype(Transport='x11')
client.Attach()
user = sys.argv[1]
message = ' '.join(sys.argv[2:])
client.SendMessage(user, message)

