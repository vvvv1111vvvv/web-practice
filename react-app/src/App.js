import logo from './logo.svg';
import './App.css';
import { useState } from 'react';

function Header(props) {
  //컴포넌트: 사용자 정의태그
  //리액트에서 함수명은 반드시 대문자로 시작.
  //props: 속성
  //console.log('props', props, props.title);
  return <header>
    <h1><a href="/" onClick={(event) => {
      event.preventDefault();//a 태그의 기본동작을 prevent
      props.onChangeMode();
    }}>{props.title}</a></h1>
  </header>
}
function Nav(props) {
  const lis = [];
  for (let i = 0; i < props.topics.length; i++) {
    let t = props.topics[i];
    lis.push(<li key={t.id}>
      <a id={t.id} href={'/read/' + t.id} onClick={(event) => {
        event.preventDefault();//a 태그의 기본동작을 prevent
        props.onChangeMode(Number(event.target.id));//event.target: event를 유발시킨 태그, 즉 a태그
      }}>{t.title}</a>
    </li>)
    //key는 반복문 안에서 고유해야 한다.
  }
  return <nav>
    <ol>
      {lis}
    </ol>
  </nav>
}
function Article(props) {
  return <article>
    <h2>{props.title}</h2>
    {props.body}
  </article>
}
function Create(props) {
  return <article>
    <h2>Create</h2>
    <form onSubmit={event => {
      event.preventDefault();// form tag의 onSubmit을 하면 페이지가 reload된다. 이를 막기위해 사용
      const title = event.target.title.value;//event.target: event를 유발시킨 태그, 즉 form태그
      const body = event.target.body.value;
      props.onCreate(title, body);
    }}>
      <p><input type="text" name="title" placeholder='title' /></p>
      <p><textarea name='body' placeholder='body'></textarea></p>
      <p><input type='submit' value='create'></input></p>
    </form>
  </article>
}
function Update(props){
  const [title, setTitle]=useState(props._title);
  const [body, setBody]=useState(props._body);
  return <article>
    <h2>Update</h2>
    <form onSubmit={event => {
      event.preventDefault();// form tag의 onSubmit을 하면 페이지가 reload된다. 이를 막기위해 사용
      const title = event.target.title.value;//event.target: event를 유발시킨 태그, 즉 form태그
      const body = event.target.body.value;
      props.onUpdate(title, body);
    }}>
      <p><input type="text" name="title" placeholder='title' value={title} onChange={event=>{//state는 컴포넌트 안에서 바꿀 수 있다.
        //console.log(event.target.value);
        setTitle(event.target.value);//컴포넌트가 바뀌고, 다시 랜더링
      }}/></p> {/*props.값은 내부 사용자가 수정 불가능*/}
      <p><textarea name='body' placeholder='body' value={body} onChange={event=>{
        setBody(event.target.value)
      }}></textarea></p>
      <p><input type='submit' value='Update'></input></p>
    </form>
  </article>
}
function App() {
  // const _mode = useState('WELCOME'); //초기 상태로 선언
  // // console.log('_mode',_mode);
  // const mode= _mode[0];//_mode[0]: 상태이름
  // const setMode= _mode[1];//_mode[1]: 상태함수
  const [mode, setMode] = useState('WELCOME'); //state
  const [id, setId] = useState(null);
  const [nextId, setNextId] = useState(4);
  const [topics, setTopics] = useState([
    { id: 1, title: 'html', body: 'html is ...' },
    { id: 2, title: 'css', body: 'css is ...' },
    { id: 3, title: 'js', body: 'js is ...' }
  ])
  let content = null;
  let contextControl=null;//맥락적으로 control
  if (mode === 'WELCOME') {
    content = <Article title="Welcome" body="Hello, WEB"></Article>
  } else if (mode === 'READ') {
    let title, body = null;
    for (let i = 0; i < topics.length; i++) {
      //console.log(topics[i].id, id)
      if (topics[i].id === id) {
        title = topics[i].title;
        body = topics[i].body;
      }
    }
    content = <Article title={title} body={body}></Article>
    //content = <Article title={topics[id - 1].title} body={topics[id - 1].body}></Article>
    contextControl = <li><a href={"/update/"+id} onClick={event=>{
      event.preventDefault();
      setMode('UPDATE');
    }}>Update</a></li>
  } else if (mode === 'CREATE') {
    content = <Create onCreate={(_title, _body) => {
      const newTopic = { id: nextId, title: _title, body: _body }
      const newTopics = [...topics]//배열 복제
      newTopics.push(newTopic);
      setTopics(newTopics);
      //setTopics(topics.push(newTopic)); original topics와 새 setTopics가 동일하기에 실행 안됨.
      setMode('READ');
      setId(nextId);
      setNextId(nextId + 1);
    }}></Create>
  } else if(mode ==='UPDATE'){
    let title, body=null;
    for(let i=0; i<topics.length; i++){
      if(topics[i].id===id){
        title=topics[i].title;
        body=topics[i].body;
      }
    }
    content =<Update _title={title} _body={body} onUpdate={(title, body)=>{
        const newTopics=[...topics] //배열복제 
        const updatedTopic={id:id, title:title, body:body}
        for(let i=0; i<newTopics.length;i++){
          if(newTopics[i].id===id){
            newTopics[i]=updatedTopic;
            break; 
          }
        }
        setTopics(newTopics);  
        setMode("READ");

    }}></Update>
  }
  return (
    <div>
      <Header title="WEB" onChangeMode={() => {
        setMode('WELCOME');
      }}></Header>
      <Nav topics={topics} onChangeMode={(_id) => {
        setMode('READ');
        setId(_id);
      }}></Nav>
      {content}
      <ul>
        <li><a href="/create" onClick={event => {
          event.preventDefault();
          setMode('CREATE');
        }}>Create</a></li>
        {contextControl}
      </ul>
    </div>
  );
}

export default App;
