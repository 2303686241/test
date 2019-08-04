## php基础

### 一、php数据类型

#### 1、php变量

**>> 变量是用于存储数据的"容器"**

- 规则（PHP 没有声明变量的命令，变量在第一次赋值给它的时候被创建）
  - 以 $ 符号开始，后面跟着变量的名称
  - 必须以字母或者下划线字符开始
  - 只能包含字母数字字符以及下划线（A-z、0-9 和 _ ）
  - 不能包含空格，区分大小写的（$y 和 $Y 是两个不同的变量）

#### 2、变量作用域 --> local、global、static、parameter

* local与global

  * 全局环境下不可访问局部变量，但局部作用域下可访问全局变量（需在全局变量前加global关键字或使用$GLOBALS[index]数组）

  ```javascript
  <?php
      $x=5;
      $y=10;
  
      function myTest()
      {
          global $x,$y;
          $y=$x+$y;
          
          // 全局变量存储在一个名为 $GLOBALS[index] 的数组中。 index 保存变量的名称。        		   // 这个数组可以在函数内部访问，也可以直接用来更新全局变量。
          $GLOBALS['y']=$GLOBALS['x']+$GLOBALS['y'];
      }
  
      myTest();
      echo $y; // 输出 15
  ?>
  ```

* static 

  * 一个函数执行完后变量都会被删除，在局部作用域下使用static关键字可保证局部变量不要被删除（static只作用于第一次）。

  ```javascript
  <?php
      function myTest()
      {
          static $x=0;
          echo $x;
          $x++;
      }
  
      myTest(); // ==> 0 
      myTest(); // ==> 1 
      myTest(); // ==> 2 
  ?>
  ```

* parameter（参数）

  * 参数是通过调用代码将值传递给函数的局部变量，是在参数列表中声明的，作为函数声明的一部分。

#### 2、php常量

**常量是一个简单值的标识符。该值在脚本中不能改变。一个常量由英文字母、下划线、和数字组成,但数字不能作为首字母出现。 (常量名不需要加 $ 修饰符)。**

* define(name, value, case_insensitive)

  - **name：**必选参数，常量名称，即标志符。
  - **value：**必选参数，常量的值。
  - **case_insensitive** ：可选参数，如果设置为 true，该常量则区分大小写。默认是区分大小写。

  ```javascript
  <?php
  // 区分大小写的常量名
  define("GREETING", "xiaoliu");
  echo GREETING;    // 输出 "xiaoliu"
  echo '<br>';
  echo greeting;   // 输出 "greeting"
  ?>
  ```

#### 3、cookie与session

##### cookie

* 1、$_COOKIE  (用于取cookie 中的值);

* 2、setcookie(‘key1’, ‘value1’);    (用于创建cookie，退出浏览器后会自动删除)

* 3-1、setcookie(‘key’)    (只传一个值，是删除cookie)
* 3-2、setcookie("user", "", time()-3600); （删除 cookie 时，应当使过期日期变更为过去的时间点）

* 5、setcookie(‘key1’, ‘value1’, time() + 1* 24 * 60 * 60);    (用于创建cookie，第三个参数是设置过期时间 time()为当前时间)

##### session --> 将数据存在服务端，留给客户端一把钥匙，客户端之只能通过钥匙去服务器取数据，保证了安全性

* 设置session

  ```java
  <?php
  session_start();
  // 存储 session 数据
  $_SESSION['views']=1;
  ?>
  ```

* 获取session

  ```javascript
  <?php
  session_start();
  if(isset($_SESSION['views']))
  {
      $_SESSION['views']=$_SESSION['views']+1;
  }
  else
  {
      $_SESSION['views']=1;
  }
  echo "浏览量：". $_SESSION['views'];
  ?>
  ```

* 销毁sesion --> unset($_SESSION['UID'])

  ```javascript
  <?php
  session_start();
  if(isset($_SESSION['views']))
  {
      unset($_SESSION['views']);
  }
  ?>
  ```

##### 4、超全局变量([详细](<https://www.runoob.com/php/php-superglobals.html>))

* $GLOBALS  -->  引用全局作用域下可用的全局变量
* $_SERVER  -->  获取服务端相关信息
* $_REQUEST -->  获取提交参数
* $_POST  -->  获取post提交参数
* $_GET  -->  获取提get交参数
* $_FILES  -->  获取上传文件
* $_ENV  -->  操作环境变量
* $_COOKIE  --> 操作cookie
* $_SESSION  -->  操作session

##### 5、php常用方法

a、 foreach($data  as $key => $value){ }

b、explode(delimiter, string)    (区分单双引，将string字符串按delimiter解析为数组)

c、 trim($data)  去除空格

d、strpos($data, ‘http://’) 等价于js中的  str.indexOf()

e、strtolower($data) 大写字母转小写    

f、substr($data, 7) 字符串截取

g、数组

```
array_merge($arr, $arr1 );  合并数组
array_count_values($val)； 计算$val出现次数
array_filter($val, 'func');  使用func方法过滤数组
in_array('xxx', $arr);   检查$arr数组是否存在xxx数据
key($val);   返回数组的key    /      array_keys($arr)   返回$arr所有的key
sort($array) 对数组进行排序
rsort($array)  对数组逆序排列
asort($array) 对数组元素进行排序，保持数组的原索引关系不变
ksort($array) 对数组元素按索引名排序，保持原数组索引关系保持不变
```

h、文件

```

file_get_contens() 将一个文件的内容读取到字符串;                  
filesize() 取得文件的大小
file_exists(filename) 判断文件是否存在
unlink(filename) 删除文件
copy(source,desc) 将source复制到desc，成功返回true
rename(oldname,newname)
--include ‘’ 用于载入公共文件，该文件存在与否不会影响后面代码执行
--require '' 载入不可缺失的文件 	
```