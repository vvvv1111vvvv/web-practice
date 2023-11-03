from flask import Flask
from flask import request
from flask import redirect
app = Flask(__name__)

topics = [{'id': 1, 'title': 'html', 'body': 'html is...'},
          {'id': 2, 'title': 'css', 'body': 'css is...'},
          {'id': 3, 'title': 'javascript', 'body': 'javascript is...'}
          ]
nextId=4

def template(contents, content, id=None):
    contextUI=''
    if id != None:
        contextUI=f'''
            <li><a href="/update/{id}/">update</a></li>
            <li><form action='/delete/{id}/' method='POST'><input type="submit" value="delete"></form></li>
            '''
    return f'''<!doctype html>
    <html>
        <body> 
            <h1><a href="/">WEB</a></h1>
            <ol>{contents}</ol> 
            {content} 
            <ul><li><a href ="/create/">create</a></li>
            {contextUI}
            </ul>      
        </body>     
    </html>
 ''' 

def getContents():
    liTags = ''
    for topic in topics:
        # liTags=liTags +'<li>'+topic[]'title']+'</li>'
        liTags = liTags + \
            f'<li><a href="/read/{topic["id"]}/">{topic['title']}<a></li>'

        # f 스트링 사용
    return liTags


@app.route('/')
def index():
    return template(getContents(), '<h2>Welcome</h2>Hello, WEB')

# #http methods 
# from flask import request
# @app.route('/login', method=['GET', 'POST'])
# def login():
#     if request.method=='POST':
#         return do_the_login()
#     else:
#         return show_the_login_form()
@app.route('/create/', methods=['GET', 'POST'])
def create():
    if request.method=='GET':
        content = '''
            <form action="/create/" method="POST">
            <p><input type="text" name="title" placeholder="title"></p>
            <p><textarea name="body" placeholder="body"></textarea></p>
            <p><input type="submit" value="create">
            </form>
            '''
        return template(getContents(), content)
    elif request.method =='POST':
        global nextId
        title=request.form['title']
        body=request.form['body']
        newTopic={'id': nextId, 'title': title, 'body':body}
        topics.append(newTopic)
        url='/read/'+str(nextId)+'/'
        nextId=nextId+1
        return redirect(url)




@app.route('/read/<int:id>/')
def read(id):
    # print(type(id))
    title = ''
    body = ''
    for topic in topics:
        if id == topic['id']:
            title = topic['title']
            body = topic['body']
            break
    return template(getContents(), f'<h2>{title}</h2>{body}',id)
@app.route('/update/<int:id>/',methods=['GET', 'POST'])
def update(id):
    if request.method=='GET':
        for topic in topics:
            if id == topic['id']:
                title = topic['title']
                body = topic['body']
                break
        content = f'''
            <form action="/update/{id}" method="POST">
            <p><input type="text" name="title" placeholder="title" value="{title}"></p>
            <p><textarea name="body" placeholder="body">{body}</textarea></p>
            <p><input type="submit" value="update">
            </form>
            '''
        return template(getContents(), content)
    elif request.method =='POST':
        title=request.form['title']
        body=request.form['body']
        for topic in topics:
            if topic['id']==id:
                topic['title']= title; topic['body']=body
                break
        url='/read/'+str(id)+'/'
        return redirect(url)
    
@app.route('/delete/<int:id>/', methods=['POST'])# 여기서 GET방식 하지 말기
def delete(id):
    for topic in topics:
        if id == topic['id']:
            topics.remove(topic)
            break
    url='/'
    return redirect(url)
#app.run(debug=True)
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
# app.run(debug=true) 실제서비스 시에는 디버그 지워야한다.
