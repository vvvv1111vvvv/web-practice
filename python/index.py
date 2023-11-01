#!python
print("content-type: text/html; charset=utf8\n")  # 헤더정보 CGI
print()
# shebang이다.
import cgi, os
import html_sanitizer
sanitizer=html_sanitizer.Sanitizer()

import view

form = cgi.FieldStorage(s)
if "id" in form:
    title=pageId = form["id"].value
    description = open("data/" + pageId, "r").read()
    #description=description.replace('<','&lt;')
    #description=description.replace('<','&gt;')
    description=sanitizer.sanitize(description)
    title=sanitizer.sanitize(title)
    update_link = '<a href="update.py?id={}">update</a>'.format(pageId)
    delete_action ='''
        <form action="process_delete.py" method="post">
            <input type="hidden" name="pageId" value="{}">
            <input type="submit" value="delete">
        </form>'''.format(pageId)
else:
    title=pageId = "welcome"
    description = "Hello,web"
    update_link=''
    delete_action=''
print(
    """
<!doctype html>
<html>
<head>
  <title>WEB1 - Welcome</title>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href="index.py">WEB</a></h1>
  <ol>{listStr}
  </ol>
  <a href="create.py">create</a>
  {update_link}
  {delete_action}
  <h2>{title}</h2>
  <p>{description}
  </p>
</body>
    </html>
      """.format(
        title=title, description=description, listStr=view.getList(), update_link=update_link, delete_action=delete_action
    )
)
# id= XXX 하는 부분: 쿼리 스트링
