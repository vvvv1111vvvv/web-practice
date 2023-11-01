#!python

import cgi

form = cgi.FieldStorage()
title = form["title"].value
description = form["description"].value
opendFile =open('data/'+title, 'w')
opendFile.write(description)
opendFile.close()
#Redirection
print("Location: index.py?id="+title)  # 헤더정보 CGI
print()
