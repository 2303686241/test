## 不知道的html

### 1、image的使用

#####  1>、利用image测网速

```javascript
<script>
var date = Date.now();
var image = new Image();
image.crossOrigin = 'anonymous'; // 启用了跨域资源共享（cors），资源服务器也得设置
image.src = 'htpp://.........png'; // 10kb
image.onload = function() {
    var new_date = Date.now();
    var ws = 10 / (new_date - date); // 单位 kb/s
}
</script>
```

> **h5的crossOrigin属性**
>
> * `anonymous`匿名的意思，对此元素的CORS请求将不设置凭据标志。
> * `use-credentials`对此元素的CORS请求将设置凭证标志; 这意味着请求将提供凭据。
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`当标签使用crossOrigin时，就是在报文头里加了请求首部字段origin，参数为请求的源地址，表示标签内请求的资源使用了跨域资源共享（cors），要想给请求成功，资源服务必须设置响应头Access-Controll-Allow-Origin，内容为请求的源地址，也就是origin的值，也可为*。`
>
> **>>  cors使用 [`Origin`](https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Headers/Origin) 和 [`Access-Control-Allow-Origin`](https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Headers/Access-Control-Allow-Origin) 来完成最简单的访问控制**
>
> ![cors原理图](https://github.com/xiaoliuing/study-notes/blob/master/imgs/cors.png?raw=true)

##### 2>、利用image打点

**image标签src的get请求**

```javascript
// 图片后的地址就是一些用户信息，传给服务器后，服务器记录访问日志，知道点击量
https://........./a.gif?....
```

### 2、css的xss攻击

> **>> XSS <<** 
>
> 1、什么是xss攻击? ? ? 
>
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`就是利用网页开发所遗留下来的漏洞,通过巧妙地方法将恶意的指令代码注入到网页，使用户加载并执行这些恶意制造的网页程序。xss攻击的恶意网页程序通常是js，也可以包括Java、VBScript、html等。攻击成功后，可以进行一些操作、会话、cookie等。`
>
> 2、攻击条件： 需要向web页面注入浏览器可执行的恶意代码。
>
> 3、攻击类型
>
> * 反射型（跟钓鱼攻击类似·，诱使用户去访问一个包含恶意代码的 URL，当受害者点击这些专门设计的链接的时候，恶意代码会直接在受害者主机上的浏览器执行。）
>
>   ```javascript
>   // 改变链接，添加js代码
>   http://127.0.0.1/index.php?param=<script>alert('xss')</script>
>   ```
>
> * 存储性XSS（攻击者事先将恶意代码上传或储存到漏洞服务器中，只要受害者浏览包含此恶意代码的页面就会执行恶意代码。）
>
> * DOM型（修改dom树结构，并插入可执行的js代码）
>
>   ```javascript
>   <img src="/images/handler.ashx?id=" /><script>alert('xss')</script><br x="" />
>   ```

**css的xss攻击是向样式表填url的地方注入浏览器可执行的js代码**

```javascript
background-image: url("javascript:eval(alert('111'))'")
```

### 3、html语义化的重要性

* 有利于SEO，有利于搜索引擎爬虫更好的理解我们的网页，从而获取更多的有效信息，提升网页的权重。
* 在没有CSS的时候能够清晰的看出网页的结构，增强可读性，便于团队开发和维护。
* 支持多终端设备的浏览器渲染。

### 4、用iframe跨域实现localStorage的扩容

**原理** `因为浏览器为了安全，禁止了不同域访问。因此只要调用与执行的双方是同域则可以相互访问。`

* 在A.html 创建一个 iframe

* iframe的页面放在 B.html 同域下，命名为execB.html

* execB.html 里有调用B.html fIframe方法的js调用

##### >>具体实现 <<

> window.frames[0].postMessage(data, origin);
>
> * `data`表示要传递的数据
> * `origin`字符串参数，指明目标窗口的源

**1、http://xiaoliuhost.com.io/test.html**

```javascript
<iframe src="http://localhost/index.html"></iframe>
<script>
    
  window.onload = function(){
    // _data[0]为缓存的key，_data[1]为缓存的value
	var _data = ["xiao", "xiaoliu"];
    
    window.frames[0].postMessage(_data, "http://localhost");
  }	

  // 监听对方传回来的数据（获得另一个域下缓存的数据）
  window.addEventListener('message', function(e) {  
	 console.log(e.data); // ==> "xiaoliu"      
  }, false);

</script>
```

**2、http://localhost/index.html**

```javascript
<script>
window.addEventListener('message', function(e) {
   if(e.source !== window.parent) {
      return;
    }
    
    localStorage.setItem(e.data[0], e.data[1); // 在该域下设置缓存
    var response_data = localStorage.getItem(e.data[0]);
    
    // 响应对方，域名为对方的域名
    window.parent.postMessage(response_data, 'http://xiaoliuhost.com.io');
})
</script>
```

