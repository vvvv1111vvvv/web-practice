#!python
print("content-type: text/html; charset=utf8\n")  # 헤더정보 CGI
print()
# shebang이다.
import cgi,os
import view

form = cgi.FieldStorage()
if "id" in form:
    pageId = form["id"].value
    description = open('data/'+pageId,'r').read()
else:
    pageId = "welcome"
    description ="Hello,web"
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
  <form action="process_update.py"  method="post">
  <input type= "hidden" name="pageId" value="{form_default_title}"
  <p><input type="text" name="title" placeholder="title" value="{form_default_title}"></p>
    <p><textarea rows="4" name="description" placeholder="description" value="{form_default_description}"></textarea></p>
        <p><input type="submit"></p>
  <h2>{title}</ {description}
  </p>
  </form>
</body>
    </html>
      """.format(
        title=pageId, description=description, listStr=view.getList(), 
        form_default_title=pageId, form_default_description=description
    )
)
# id= XXX 하는 부분: 쿼리 스트링
