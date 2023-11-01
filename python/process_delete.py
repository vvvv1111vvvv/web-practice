#!python

import cgi,os

form = cgi.FieldStorage()
title = form["pageId"].value
os.remove('data/'+title)
#Redirection
print("Location: index.py")# 헤더정보 CGI
print()
