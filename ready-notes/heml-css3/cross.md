##  跨域问题以及解决办法

#### 一、跨域问题

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`跨域，指的是浏览器不能执行其他网站上的脚本。由浏览器的同源策略引起的，是浏览器施加的安全机制。同源是指域名、协议、端口均一样`

**同源策略影响**

* cookie、LocalStorage无法获取
* dom和js的无法获取
* ajax请求发送不出去

#### 二、跨域的解决方案

##### 1、jsonp跨域（ jsonp只能发送get请求，不支持post请求）

**原理：** 利用script标签不受跨域影响的这一特点，可在其src属性上做文章。设置src为请求的脚本路径并向其它域传递一个callback参数或者在开始定一个callback方法，通过其它域的后台将callback参数作为函数名和json串包装成js函数返回给浏览器，浏览器通过callback方法的参数就得到了后端返回的json数据了。

```javascript
// 写法一
<script src="localhost:8081/aa/index.php">
    function success(data) {
    	console.log(data);
	}    
</scrip>

// 写法二
<script>
    var script = document.createElement('script');
    script.type = 'text/javascript';

    // 传参一个回调函数名给后端，方便后端返回时执行这个在前端定义的回调函数
    script.src = 'http://www.domain2.com:8080/login?user=admin&callback=handleCallback';
    document.head.appendChild(script);

    // 回调执行函数
    function handleCallback(res) {
        alert(JSON.stringify(res));
    }
 </script>
```

##### 2、cors跨域资源共享

**跨域资源共享（Cross-Origin Resource Sharing，简称 CORS），是 HTML5 提供的标准跨域解决方案。**

