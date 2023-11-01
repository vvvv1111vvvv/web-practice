
#!python

import cgi,os

form = cgi.FieldStorage()
pageId=form["pageId"].value
title = form["title"].value
description = form["description"].value
opendFile =open('data/'+pageId, 'w')
opendFile.write(description)
os.rename('data/'+pageId, 'data/'+title)
opendFile.close()
#Redirection
print("Location: index.py?id="+title)  # 헤더정보 CGI
print()
