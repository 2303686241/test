## 初识php

### 一、php简述

* PHP（全称：PHP：Hypertext Preprocessor，即"PHP：超文本预处理器"）是一种通用开源脚本语言。PHP 是一种创建动态交互性站点的强有力的服务器端脚本语言。

### 二、php简介

* PHP 文件可包含文本、HTML、JavaScript代码和 PHP 代码。
* PHP 代码在服务器上执行，结果以纯 HTML 形式返回给浏览器。
* PHP 文件的默认文件扩展名是 ".php"。

> ? ? ? php能做什么呢！
>
> * 生成动态页面内容，创建、打开、读取、写入、关闭服务器上的文件
> * 收集表单数据，发送和接收 cookies
> * 添加、删除、修改您的数据库中的数据
> * 限制用户访问您的网站上的一些页面，加密数据
> * ...............
>
> `>> 通过 PHP，您不再限于输出 HTML。您可以输出图像、PDF 文件，甚至 Flash 电影。您还可以输出任意的文本，比如 XHTML 和 XML`

### 三、php优点

* php可在不同的的平台上运行（Windows、Linux、Unix、Mac OS X 等）

* PHP 与目前几乎所有的正在被使用的服务器相兼容（Apache、IIS 等）

* PHP 提供了广泛的数据库支持

* PHP 是免费的，可从官方的 PHP 资源下载它：[ www.php.net](http://www.php.net/)

* PHP 易于学习，并可高效地运行在服务器端

  ### 四、

### 四、up code！！！

```javascript
<!DOCTYPE html> 
    <html> 
    <body> 

    	<?php
        // 这是 PHP 单行注释

            /*
            这是 
            PHP 多行
            注释
            */
        ?>
        <h1>My first PHP page</h1> 

        <?php 
        echo "Hello World!"; 
        ?> 

    </body> 
</html>
```

#### 基本语法

1、PHP 脚本可以放在文档中的**任何位置**。

2、PHP 脚本以 **<?php** 开始，以 **?>** 结束：

3、PHP 文件的默认文件扩展名是 ".php"。

4、PHP 文件通常包含 HTML 标签和一些 PHP 脚本代码。

5、PHP 中的每个代码行都必须以分号结束（**分号是一种分隔符，用于把指令集区分开来**）。

6、通过 PHP，有两种在浏览器输出文本的基础指令：**echo** 和 **print**。