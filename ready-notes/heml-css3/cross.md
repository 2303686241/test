##  跨域问题以及解决办法

### 一、跨域问题

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`跨域，指的是浏览器不能执行其他网站上的脚本。由浏览器的同源策略引起的，是浏览器施加的安全机制。同源是指域名、协议、端口均一样`

**同源策略影响**

* cookie、LocalStorage无法获取
* dom和js的无法获取
* ajax请求发送不出去

### 二、跨域的解决方案

#### 1、jsonp跨域（ jsonp只支持get请求，不支持post请求）

**原理：** 利用script标签不受跨域影响的这一特点，可在其src属性上做文章。设置src为请求的脚本路径并向其它域传递一个callback参数或者在开始定一个callback方法，通过其它域的后台将callback参数作为函数名和json串包装成js函数返回给浏览器，浏览器通过callback方法的参数就得到了后端返回的json数据了。

##### a、前端（<http://xiaoliuhost.com.io/test.html>）

```javascript
// --------------- 写法一 ----------------------------------
<script type="text/javascript">
	function resCallback(data) {
		console.log(data.name); // ==> "xioliu"
	}
</script>
<script src="http://localhost:8080?jsonp=true&callback=resCallback"></script>

// --------------- 写法二 ----------------------------------
<script>
    var script = document.createElement('script');
    script.type = 'text/javascript';

    // 传参一个回调函数名给后端，方便后端返回时执行这个在前端定义的回调函数
    script.src = 'http://localhost:8080?jsonp=true&callback=resCallback';
    document.body.appendChild(script);

    // 回调执行函数
    function resCallback(data) {
		console.log(data.name); // ==> "xioliu"
	}
</script>
```

##### b、node后端（http://localhost:8080）

```javascript
const http = require('http');
const url = require('url');
// 将get请求参数转换成对象
const queryString = require('query-string');

let server = http.createServer();

server.on('request', (req, res) => {
	let url_data = url.parse(req.url).search;
    // url_data ==> ?jsonp=true&callback=resCallback
	let url_obj = queryString.parse(url_data);

	if(url_obj.jsonp) { // 判断是否为jsonp请求
		let { callback } = url_obj;
        // 数据必须用引号包裹，或用JSON.stringify()转换为JSON字符串
		let data = JSON.stringify({name: xiaoliu});// JSON试用于对象或数组
        // or 
        // let data = '{name: xiaoliu}' | '1111' | '"xioaliu"';
		let _res = callback +"("+ data +");";
		res.end(_res);
	} else {
		res.end('success');
	}
});

server.listen(8080, () => {
	console.log('Server Running.......');
});
```

#### 2、cors跨域资源共享

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;跨域资源共享（Cross-Origin Resource Sharing，简称 CORS），是 HTML5 提供的标准跨域解决方案。浏览器的同源策略会限制从脚本发送的跨源http请求，而cors可以解决了这一问题。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其原理就是用额外的http头来告诉浏览器运行在origin的应用允许访问来在不同源服务器上的指定资源。当一个资源请求另一个不同源服务器上的资源时，会发起一个http跨域请求。

##### a、简单跨域

就是利用 `Origin`和 `	`完成的访问控制，当需要凭据cookie时, 响应头要多加一个字段`Access-Control-Allow-Credentials`设为true，前端还要打开ajax的withCredentials属性。

![cors.png](<https://raw.githubusercontent.com/xiaoliuing/study-notes/master/imgs/cors.png>)

* **满足简单请求的条件**
  * 请求方法是这三种：HEAD、GET、POST
  * HTTP 的头信息不超出这几种字段：Accept、Accept-Language、Content-Language、Last-Event-     ID、Content-Type (只限于三个值 application/x-www-form-urlencoded、multipart/form-data、text/plain)

* 实例

  * 前端

    ```javascript
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8080/index', true);
    // xhr.withCredentials = true;  // 设置携带凭证cookie
    xhr.send();				
    xhr.onload =  function(){
    　　console.log(xhr.responseText); // ==>  'cors success'
    }
    ```

  * node后端

    ```javascript
    const http = require('http');
    let server = http.createServer();
    
    const originList = {    // 允许跨域的origin白名单
    	"http://xiaoliuhost.com.io": true,
    	"http://www.asda.com": true,
    	"http://ascsa.io": true
    }
    
    server.on('request', (req, res) => {
    	let { origin } = req.headers;  // 获取http请求头origin字段
    	if(originList[origin]) {
            // 当请求中携带cookie时, Access-Control-Allow-Origin必须要有确切的指定, 不能是通配符(*), 而withCredentials是跨域安全策略的一个控制属性
    		res.setHeader("Access-Control-Allow-Origin", origin);
            //res.setHeader("Access-Control-Allow-Credentials", "true");
    		res.end('cors success');
    	}
    	res.end('success');
    })
    
    server.listen(8080);
    ```

##### b、非简单请求

非简单请求就是在正式请求之前，增加一次HTTP请求，也称预检请求。

浏览器先询问服务器，服务器判断当前域名是否在许可名单中，并响应浏览器使用哪些动词和头信息字段。只有得到服务器的许可之后，浏览器才会正式的发送HTTP请求，否则就报错。

- 预检阶段
  - 请求用到的方法是`OPTIONS`，表示这个请求是用来询问的。
  - 满足条件
    - 请求方法**不是**下列之一：
      - `GET`
      - `HEAD`
      - `POST`
    - 请求头中的Content-Type请求头的值**不是**下列之一：
      - `application/x-www-form-urlencoded`
      - `multipart/form-data`
      - `text/plain`
  - 请求头信息包含几个特殊字段
    - `origin`同简单请求一样 （必填）
    - `Access-Control-Request-Method：`列出浏览器会用到哪些CORS请求的HTTP方法。（必填）
    - `Access-Control-Request-Headers` : 该字段是一个逗号分隔的字符串，指定浏览器 `CORS` 请求会额外发送的头信息字段
  - 响应头包含的字段
    - `Access-Control-Allow-Origin`
    - `Access-Control-Allow-Methods:` 允许请求的类型
    - `Access-Control-Allow-Headers: `指定HTTP能拿到的其他字段，以逗号分开
    - `Access-Control-Max-Age：`指定本次预检请求的有效期，单位为秒。在有效期间，不用发出另一条预检请求
    - `Access-Control-Allow-Credentials：`  是否允许发送 `Cookie`
- 正式请求阶段（同简单请求）









