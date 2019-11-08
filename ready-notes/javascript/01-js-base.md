# js笔记

## 1、主流浏览器及其内核

* Google Chrome（谷歌）                     webkit/blink
*  Firefox（火狐）                                   Gecko
* IE                                                             trident
* Safari（苹果）                                       webkit
* Opera                                                      presto3

> 浏览器由shell层（浏览器的外壳：例如菜单，工具栏 等）和内核组成
>
> * 内核（浏览器的核心）
>   * 渲染引擎（语法规则和渲染）
>   * js引擎
>   * 其他模块

## 2、什么是js

`JS是JavaScript的简称，是一种直译式脚本语言，是一种动态类型、弱类型、基于原型的语言，内置支持类型。它的解释器被称为JavaScript引擎，为浏览器的一部分，广泛用于客户端的脚本语言，最早是在HTML网页上使用，用来给HTML网页增加动态功能。`

> * 语言分类
>   * java不属于以下两种语言
>     * java文件---->javac编译成.class文件------>由jvm虚拟机解释执行
>   * 编译语言：先通篇翻译该文件内容，得到一个翻译后的文件，系统在执行翻译后得到文件
>     * 优点：快
>     * 不足移植性不好（不夸平台）
>     * C       C++
>   * 解释语言：翻译一行，然后系统执行一行
>     * 优点：跨平台
>     * 不足：稍微慢
>     * javascript      php

## 3、js运算符

```javascript
//undefined null NaN  ''  ""  0  false   ==>   boolean 值均为false
//注意：' '  " "   ==> 空格字符串为true


/*&& 运算符  ----------------------------------------------------------
 *先看第一个表达式，若为假，直接返回false，若为真，则接着读第二个表达式，以此类推
 *	若读到最后一个表达式仍为真，则返回最后一个表达式的结果
*/
var a = 0 && 2 + 2;
document.write(a);    // ==>  false
var a = 1 && 2 + 2;   // ==>  4
var a = 1 + 1 && 1 - 1;  // ==> 0
2 > 1 && document.write('袁腾飞天涯');    // ==> 袁腾飞天涯

// & 与运算    ----------------------------------------------------------
var a = 1 & 3;   // ==> 01 与 11  == 01



/*|| 运算符    ----------------------------------------------------------
 *先看第一个表达式，若为真，直接返回第一个表达式的结果，若为假，则接着读第二个表达式，以此类推
 *	若读到最后一个表达式仍为假，则返回最后一个表达式的结果（除了false 返回false，其他均不为false）
*/
var num = 0 || false || 1;    // ==> 1
var num = 0 || 0;     // ==> 0
var num = 0 || false;     // ==> false
var num = 0 || false || NaN;    // ==> NaN



/*   ! 非运算符     ----------------------------------------------------------
*/
var a = !'abc';   // ==> false
var a = !!'abc';  // ==> true



/* + - * /    ----------------------------------------------------------
*/
//   +
var a = 1 + 1;     // ==> 2
var a = '1' + 1;   // ==> 11  /从左到右，若读到一个字符串，则会将后面的数字转为string类型
var a = 1 + '1' + (1 + 1);  // ==> 112    /分优先级
var a = +'111';    // ==> 111   number 类型
var a = +'11aa';   // ==> NaN   number 类型

//   -
var a = 1 - 1;     // ==> 0
var a = -'111';    // ==> -111  number 类型
var a = -'11aa';   // ==> NaN   number 类型

//    * /
var a = '2' * 4;     // ==> 8    number 类型
var a = '1' * '3';   // ==> 3    number 类型(字符串转为string类型)
var a = 'a' * '1';   // ==> NaN  number 类型

var a = 0 / 0;       // ==> NaN
var a = 1 / 0;       // ==> Infinity 无穷
var a = 0 / 1;       // ==> 0
```

## 4、typeof()    toString()   isNaN()  parseInt()

* typeof()     查看数据类型（也可写成    typeof  数据 ），返回的结果为字符串
  * typeof(NaN)       		// ==> number
  * typeof(undefined)            // ==> undefined
  * typeof('')                             // ==> string
  * typeof(null)                        // ==> object   (null被认为是给对象占位的)
  * typeof([])                           // ==> object
  * typeof({})                            // ==> object
  * typeof(new xxxx)               // ==> object
  * typeof(true)                        // ==> boolean
  * typeof(typeof(undefined))   // ==> string    typeof(undefined)返回的结果被转化为字符串
* tostring()      字符串转换
  * **.tostring(2)       // 将数字转化为二进制数，再转为字符串
* isNaN()      不是一个数字(先转换为number类型)
  * isNaN(1)                     // ==> false
  * isNaN('')                     // ==> false
  * isNaN(null)                // ==> false
  * isNaN(undefined)    // ==> true
  * isNaN('abc')               // ==> true
  * isNaN(NaN)               // ==> true
* parseInt()     整型数字转换
  * parseInt(num, 2);           //将num定义为二进制数，在转换为整型的十进制数

## 5、解决函数e在浏览器的兼容性

```javascript
div.onclick = functionm(e) {
    var e = e || window.event;
}
```

## 6、函数

### (1) argument

```javascript
function fun(a, b){
    //arguments[] 形参的映射，可改变形参的值,若只传一个参数，那么形参b，就未被映射到arguments中
    b = 2;
    console.log(arguments[0]);
    console.log(arguments[1]);
}

fun(1,1);    // ==> 1  2
fun(1);      //1   undefined
```

### (2)  charAt()

```javascript
//charAt()   取字符串指定位置的数据  
var a = 'abc';
a.charAt(1);     // ==> "b"
```

####  (3)  计算n的阶层

``` 
function jc(n) {    //递归
    if(n == 1 || n == 0) {
        return 1;
    }
    return n * jc(n - 1);
}
jc(5);
```

## 7、js执行三部曲

### (1)语法分析   (先通篇扫描，看看有没有语法错误，有错误就会终止程序执行，比如有中文的 '' ; '' )

### (2)预编译  (发生在函数执行的前一刻)

#### 1)  预编译前奏

> window相当于一个域（库）

> 1、imply global暗示全局变量：任何变量，在未经声明就赋值，此变量为全局变量（window对象）所有
>
> ​	eg ： a = 10 ;   ==    window.a = 10;     ==    window   {   a: 10  }      
>
> 2、一切声明的全局变量均为window的属性
>
> ​	eg：var   a =  10 ;    ==   window.a = 10;     ==    window   {   a: 10  }
>
> 

#### 2)预编译四部曲

* 1、创建AO对象

* 2、找形参和变量声明，将形参名和变量作为AO属性名，值为undefined

* 3、将实参值和形参统一

* 4、在函数体里找函数声明，AO对象上的对应的属性（变量）的值赋予函数体

  ```javascript
  function fun(a) {
      console.log(a);
      
      var a = 123;
      console.log(a);
      
      function a() {};
      console.log(a);
      
      var b = function() {};
      console.log(b);
      
      function d() {};
  }
  fun(1);  //预编译发生在函数执行的前一刻
  
  /*预编译过程
  （1）创建AO（Actication Object：执行上下文或作用域）对象
  	AO {
  
  	}
  （2）
  	AO {
  		a: undefined,
  		b: undefined
  	}
  （3）
  	AO {
  		a: 1,
  		b: undefined
  	}
  (4)
  	AO {
  		a: function a() {},
  		b: undefined,
  		d: function d() {}
  	}
  */
  
  /*函数执行过程
  |2	console.log(a);    //function a() {}
  
  ---var a = 123; ==> 预编译时 a 已经声明提升过过，所以该步是 给a赋值，不会执行变量声明过程
  	AO {
  		a: 123,
  		b: undefined,
  		d: function d() {}
  	}
  |5	console.log(a);    //123
  
  ---函数体部分已被声明提升了，就是优先执行了，所以执行过程中会被略过
  
  |8	console.log(a);    //123
  
  ---给 b 赋予函数体
  	AO {
  		a: 123,
  		b: function b() {},
  		d: function d() {}
  	}
  
  |11	console.log(b);    //function b() {}
  
  */
  ```

  

#### （3）解释执行（读一行解释执行一行）

## 8、作用域、作用域链

* [[scope]]：每个javascript函数都是一个对象，对象有些属性我们可以访问，但有些不可以，这些仅供javascript引擎存取，[[scope]]就是其中一个。[[scope]]指的是我们所说的作用域，其中存储了运行期上下的集合。
* 作用域链：[[scope]]所存储的是执行期上下文的集合，这个集合呈链式链接。

> * 运行上下文：当函数执行时，会创建一个称为执行上下文的内容对象，一个执行期上下文定义了一个函数执行的环境，函数每次执行时对应的执行上下文都是独一无二的，所以每次函数调用时可能会创建多个执行上下文，当函数执行完毕，它所产生的执行上下文被销毁。
> * 查找变量：从作用域链的顶端一次向下查找。

```javascript
function a() {
    function b(){
        console.log(cc);
        function c() {
            var cc = 123;
        }
        c();
    }
    b();
}
var glob = 100;
a();	


/**GO: Gloal Object   AO: Actication Object

  a; undefined  a.[[scope]]  -->   0 : GO {}
  
  a: doing      a.[[scope]]  -->   0 ; a.AO {}
  								   1 : GO {}
  
  b: undefined  b.[[scope]]  -->   0 : a.AO {}
  								   1 : GO {}
  								
  b: doing      b.[[scope]]  -->   0 : b.AO {}
  								   1 : a.AO {}
  								   2 : GO {}
  								   
  c: undefined  b.[[scope]]  -->   0 : b.AO {}
  								   1 : a.AO {}
  								   2 : GO {}
  								
  c: doing      b.[[scope]]  -->   0 : c.AO {}
  								   1 : b.AO {}
  								   2 : a.AO {}
  								   3 : GO {}

*/
```

![a](https://github.com/xiaoliuing/study-notes/blob/master/imgs/js/2.png?raw=true)![b](https://github.com/xiaoliuing/study-notes/blob/master/imgs/js/3.png?raw=true)

##  9、闭包

###  （1）闭包概念：一个函数保存了另一个函数作用域的变量（拿了别人的东西）。

```javascript
function a() {
    var num = 10;
    function  b(){
        num ++;
        console.log(num);
    }
    return b;     // --> a.AO {}   GO {}
}
var demo = a();
demo();      // ==> 101   doing --> b.AO {}   a.AO {}   GO {}
			 //			  did(释放b.AO{}) -->  a.AO {}   GO {}

demo();      // ==> 101   doing --> b.AO {}   a.AO {}   GO {}
			 //			  did(释放b.AO{}) -->  a.AO {}   GO {}

```

> ​	弊端： 闭包会导致原有作用域链不被释放，造成内存泄漏。

###  （2）闭包作用

* **实现公有变量**

  * ```javascript
     //函数累加器
    function a() {
        var num = 10;
        function  b(){
            num ++;
            console.log(num);
        }
        return b;     // --> a.AO {}   GO {}
    }
    var demo = a();
    demo();    // ==> 101
    demo();	   // ==> 102
    demo();    // ==> 103
    demo();    // ==> 104
    ```

* **可以做缓存（存储结构）**

  * ```javascript
    function eater() {
        var food = "";
        var obj = {
            eat: function () {
                console.log('i am eating ' + food);
                food = "";
            },
            push: funstion (myfood){
            	food = myfood;
        	}
        }
    	return obj;
    }
    var eater1 = eater();
    eater1.push('fish');
    eater1.eat();
    ```

* **可以实现封装，属性私有化**

* **模块化开发，防止污染全局变量**

###  （3）闭包拓展题

> ```javascript
> function test () {
>     var arr = [];
>     for(var i = 0; i < 10; i ++) {
>         arr[i] = function () {      //给arr[i] 定义一个函数，并未执行
>             console.log(i);
>         }
>     }
>     return arr;
> }
> var arrfun = test();
> for(var j = 0; j < 10; j ++) {
>     arrfun[j]();          //10 10 10 10 10 10 10 10 10 10
> }
> 
> 
> 
> //解决输出 0 1 2  3 4 5 6 7 8 9 （立即执行函数）
> function test () {
>     var arr = [];
>     for(var i = 0; i < 10; i ++) {
>         
>         (function(j) {
>             arr[i] = function() {
>                 console.log(j);
>             }
>         }(i))
>         
>     }
>     return arr;
> }
> var arrfun = test();
> for(var j = 0; j < 10; j ++) {
>     arrfun[j]();          //0 1 2  3 4 5 6 7 8 9
> }
> 
> ```
>
> 

# 10、立即执行函数

###  概念：此类函数没有函数声明，引用会出错（undefined）执行完立即销毁/释放，适合做初始化工作。

```javascript
概念：只有表达式（字符串、数字等）才能被执行符号('()')执行
//-----  1
(function(){})()   //外层（）被识别为数学运算中的括号，内容被当作表达式
(function(){}())   //同上 执行符号('()')里可赋予形参值

function a() {}();  //()前是 函数声明，会报简单的语法错误
var text = function () {}()  //()前是函数表达式，所以可执行,但执行中函数名被忽略
							 //所以打印 text 会报 undefined 错误

+ function test() {}();    //函数后加立即执行符号后，执行中会忽略表达式的名字/引用 test
						   //+ - ！ 均能将函数声明转化为表达式，所以可执行
//初始化数据
var num = (function(a, b) {
   return a + b; 
}(1,2))
```

##  11、对象

###  （1）增删改查

```javascript
var obj = {
    name: '小刘',
    age: 19,
    gender: 'female',
    food: '',
    eat: function () {
        this.food = 'banana';
    },
    zhang: function () {
        age ++；
    }
}

obj.hobbies = 'ball';
delete obj.gender;
obj.name = '小张';
console.log(obj.age);
```

###  (2)构造函数

```javascript
//系统自带的构造函数    Object();
var obj = new object();   //new时构造函数会返回一个对象
obj.name = '小刘'；



function TheNewObject(){
    //var this = {};   
    this.name = '小刘'；
    this.age = 19;
    this.fun = function(){
        console.log('fun0');
    }
    return {};  //new  会得到一个空对象
    return 123; //new 时构造函数只能返回 对象 ，原始值会被替换成this
    			//TheNewObject();  直接执行才能返回原始值  123
    //return this;
}

/*-----  构造函数内部原理  -------------
	1、在函数体最前端加上 var this = {}
	2、执行  this，xxx = xxxx;
	3、最后隐式返回 this
*/
//new 一个构造函数时，构造函数执行首先会生成 this 对象，最后将 this 返回，所以 neew 得到的是对象
var neew = new TheNewObject();


//-------原始值   原始值对象
var a = 123;     //原始值

var a = new Number(123);  //原始值对象(数字类型对象)

a * 123;       //数字类型对象 参加运算后  变成了纯数字

a.abc = 'abc';			//原始值对象 能添加属性  和  方法
a.fun = function() {
    return 'wer';
}
```

##  12、包装类

```javascript
var a = 123;
//不会报错  但系统会自动 new 一个 123 number类型的对象，将此行代码隐式改写，然后销毁
a.nmae = 'abc';   //new Number(123).nmae = 'abc';  --> 销毁

console.log(a.nmae);   // ==> undefined （new Number(123).nmae）
----------------------------------------------------------------------------
var a = '123';
a.length = 2;  //new String(123).length = 'abc';  --> 销毁
concole.log(a);   // ==> '123'
concole.log(a.length);   // ==> 3  (new String(123).length)  String内部自带的方法


```

##  13、原型、原型链 、apply/call

###  （1）原型

**定义：**原型是function对象上的一个属性，它定义了构造函数的公共祖先，通过该构造函数产生的对象，继承了该原型的属性和方法。

#### 1》constructor（构造器，找儿子，也可能找错（修改原型的constructor指向），原型中有改属性）

```javascript
Person.prototype.name = '小刘';
function Person(){
    
}
function Car() {
    
}
var person = new Person();
//Person.prototype = {     constructor  会找错
//    constructor: Car
//}
console.log(Person.prototype);			//{
//											name: '小刘',
//											constructor: f Person(),
//											__proto__: object
										//}
```

####  2》________proto____（找爸爸，可以换爸爸（与new的位置有关），只有new时才会在函数顶部生成）

```javascript
Person.prototype.name = '小刘';
function Person(){
    //var this = {
    //   __proto__: Person.prototype
    //}
    
    //return this;
}
var person = new Person();  //new 时会在 构造函数this生成一个属性__proto__，该属性值指向该函							  //	数的原型对象,但该属性值也可改变
//----------------------1
person.name = '小刘';

//	person.__proto__ = Object{
//   	 nmae: '小刘'
//	}

//-----------------2
function obj = {
    name: '小三'
}
person.__proto__ = obj;     // __proto__   决定该函数的原型指向问题
person.name = '小三';

//----------------3
Person.prototype = {   //Person.prototype  换了个对象空间，但 __proto__仍然指向原来的空间
    name: '小张'
}
person.name = '小刘'; 
```

###  （2）原型链（找祖宗）

```javascript
//Grand.protoytpe.__proto__ = Object.prototype  //绝大多数原型的终端
Grand.protoytpe.doing = 'smoking';
function Grand () {
    
}

Father.prototype = Grand;
function Father () {
    this.num = 100;
}

Son.protogtype = Father;
function Son (){
    this.name = '小刘';
    //this.num = xxx;
}

var son = new Son();
console.log(son.name);  // ==> '小刘'
console.log(son.num);	// ==> 100
console.log(son.doing);	// ==> 'smoking'
console.log(son.num ++);// ==> 101 (this.num = this.num + 1) 
console.log(son.num)	// ==> 101 访问的时 Son 函数里的 num 属性
```

> Obiect.create();  实现类式继承,这是一个所有版本JavaScript都支持的单继承。
>
> ```javascript
> 使用 Object.create 的 propertyObject参数节
> var o;
> 
> // 创建一个原型为null的空对象
> o = Object.create(null);
> 
> 
> o = {};
> // 以字面量方式创建的空对象就相当于:
> o = Object.create(Object.prototype);
> 
> 
> o = Object.create(Object.prototype, {
>   // foo会成为所创建对象的数据属性
>   foo: { 
>     writable:true,
>     configurable:true,
>     value: "hello" 
>   },
>   // bar会成为所创建对象的访问器属性
>   bar: {
>     configurable: false,
>     get: function() { return 10 },
>     set: function(value) {
>       console.log("Setting `o.bar` to", value);
>     }
>   }
> });
> 
> 
> function Constructor(){}
> o = new Constructor();
> // 上面的一句就相当于:
> o = Object.create(Constructor.prototype);
> // 当然,如果在Constructor函数中有一些初始化代码,Object.create不能执行那些代码
> 
> 
> // 创建一个以另一个空对象为原型,且拥有一个属性p的对象
> o = Object.create({}, { p: { value: 42 } })
> 
> // 省略了的属性特性默认为false,所以属性p是不可写,不可枚举,不可配置的:
> o.p = 24
> o.p
> //42
> 
> o.q = 12
> for (var prop in o) {
>    console.log(prop)
> }
> //"q"
> 
> delete o.p
> //false
> 
> //创建一个可写的,可枚举的,可配置的属性p
> o2 = Object.create({}, {
>   p: {
>     value: 42, 
>     writable: true,
>     enumerable: true,
>     configurable: true 
>   } 
> });
> ```
>
> toString()
>
> ```javascript
> var num = 1213;
> num.toString();  // ==> new Number(num).toString();
> // Number.prototype.__proto__ = Object.prototyope   //终端有toString f
> //Number.prototype.toString = function(){}   //toString 可重写
> 
> 
> //##document.write()  打印会调用 toString()
> var obj = Object.create(null);
> //document.wirte(obj);    //会报错  （obj.toString()）  null不存在原型 toString()方法						   // 访问不到
> obj.toString = function () {
>     return '666';
> }
> document.wirte(obj);   // ==> 666
> ```
>
> toFixed()  保留几位小数

###  （3）call/apply

####  a、作用：改变this指向，借用别的函数实现自己的功能

####  b、区别：传参列表不同（形参/形参数组）

```javascript
function Peron (name, age, gender) {
    this.name = name;
    this.age = age;
    this.gender = gender;
}

function obj(name, age, gender, hobbies) {
    Person.call(this, name, age, gender);
    Person.apply(this, [name, age, gender]);
    this.hobbies = hobbies;
}
var person = new Person('小刘', 19, 'female', 'ball');
```

##  14、继承模式、命名空间、对象权举

### （1）继承模式

####  a、圣杯模式

```javascript
function inhert (Target, Origin) {  //3,4两行不能互换位置
    function F() {};
    F.prototype = Origin.prototype;
    Target.prototype = new F();
    Target.ptototype.constuctor = Target;
    Target.prototype.uber = Origin.prototype;
}

//高端写法
var inhert = (funciton(Target, Origin){
    function F() {};   //闭包私有变量
	return function() {
    	F.prototype = Origin.prototype;
    	Target.prototype = new F();
    	Target.ptototype.constuctor = Target;
    	Target.prototype.uber = Origin.prototype;
	}
})(Target, Origin)

Father.prototype.lastname = '小刘';
function Father () {
    
}
function Son () {
    
}
inhert(Son, Father);
var son = new Son();
var father = new Father();
```

### （2）命名空间：管理变量，防止污染全局，适用于模块化开放

```javascript
var nmae = 'xiaozhang'
var initLX = (function () {
    var name = 'xioaliu';   //变量私有化
    function getName() {
        conxole.log(name)
    }
    return function() {
        getName();
    }
})();
var initHK = (function () {
    var name = 'xioahan';   //变量私有化
    function getName() {
        conxole.log(name)
    }
    return function() {
        getName();
    }
})();
initLX();   // ==> xiaoliu
initHK();   // ==> xioahan
```

###  （3）对象权举

####  for  in   /   hasOwnProperty   /   in   /   instanceof

```javascript
/*
	for  in   遍历对象属性
	 hasOwnProperty  判断对象下有无定义该属性
	 in   判断该对象能访问到的属性，包括通原型访问到的属性
     A instanceof B  判断A对象是不是在B构造函数构造出来的(判断A对象的原型链上有没有B的原型)
*/
var obj = {
    name: 'xoliu',
    age: 19,
    gender: 'male',
    hobbies: 'ball'，
    __proto__: {
    	lastname: 'jmsdf'
	}
    //prop: 'asd'
}
//obj.name  ==   obj['name']
for(var prop in obj) {  //prop 为字符串类型
    console.log(obj.prop);   //5个undefined  
    						 //obj.prop --> obj['prop'] 访问的是obj中prop的属性
    console.log(obj[prop]):  // yes
    
    if(obj.hasOwnProperty(prop))  //访问到 __proto__时，返回 false
       console.log(obj[prop]);    // 不会访问到 __proto__
    }
}

//    in
console.log('name' in obj); //true
console.log('lastname' in obj); //true

//   instanceof
```

##  15、this

###  a、函数预编译过程中this  -->  window

###  b、全局作用域this --->   window

###  c、call/apply  可改变this 指向

###  d、obj.fun();      fun() 里的this指向obj（调用者）

```javascript
var namr = '111';
var a = {
    name: '222',
    say: function() {
        console.log(this.name);
    }
}
var fun = a.say;  //fun取得a对象的say属性的函数体
fun();   // ==> 111   全局作用域调用  this --> window
a.say(); // ==> 222
var b= {
    name: '333',
    say: function (fun) {
        //this --> b
        fun();    //fun是函数体 没有调用者 是全局调用
    }
}

b.say(a.say); // ==> 111
b.say = a.say;
b.say();  // ==> 333
```

##  16、arguments(只有两个属性  length  callee)

### arguments.callee （获取当前函数引用/函数体）

```javascript
function test() {
    console.log(arguments.callee); //function test() {console.log(arguments.callee)}
    console.log(arguments.callee == test);  //true
}
test();


//实际应用
var a = (function (n) {
    if(n == 1) {
       return 1;
    }
    return n * arguments.callee(n-1);
})(100);
```

> ​	fun.caller        当前调用fun的函数对象，即fun的执行环境，如果fun的执行环境为window则返回null 
>
> ```javascript
> function test() {
>     demo();
>     console.log(test.caller);  // ==> null
> }
> function demo() {
>     console.log(demo.caller);  // ==> function test() {demo();}
> }
> test();
> ```

##  17、克隆

###  （1）浅克隆

```javascript
var obj = {
    name: 'sdsdf',
    age: 19,
    arr: ['xiaoliu', 'xiaozhang']
}
var obj1 = {}

function clone(Origin, Target) {
    var Target = Target || {};
    for(var prop in obj) {
        if(obj.hasOwnProperty(prop)) {
           obj1[prop] = obj[prop];
        }       
    }
    return Target;
}
clone(obj, obj1);   //arr  指向同一个数组对象
```

###  （2）深克隆

```javascript
   var obj = {
      name: '小刘',
      age: 19,
      nu: null,
      arr: ['qwe', [1,2], [{name: 'asd'}, '123']],
      objj: {
        nmae: 'wds',
        age: 18
      }
    }

    var obj1 = {};

    function deepClone (origin, target) {
      var target = target || {};
      var objStr = Object.prototype.toString;
      var arrTos = "[object Array]";
      for(var prop in origin) {
        if(origin.hasOwnProperty(prop)) {
          if(typeof(origin[prop]) == "object" && origin[prop] !== "null") {
            target[prop] = objStr.call(origin[prop]) == arrTos ? [] : {};
            deepClone(origin[prop], target[prop]);
          } else {
            target[prop] = origin[prop];
          }
        }
      }
      return target;
    }
	deepClone (obj, obj1);
```

##  18、数组

###  （1）方法

####  a、改变原数组

```javascript
//push()   从尾部加
var arr = [1,2];   
arr.push(3);    // [1,2,3]
arr.push(4,5,6); // [1,2,3,4,5,6]

//pop()  从数组最后一位剪切,只能剪切一位,跟传参没关系
var arr = [1,2,3,4];
arr.pop();     // ==> 4   --> [1,2,3]
arr.pop(4);     // ==> 3   --> [1,2]

//unshift()   从头部加
var arr = [1,2]; 
arr.unshift(3);  // [3,1,2]
arr.unshift(4,5,6);  // [4,5,6,3,1,2]

//shift()    从头部减
var arr = [1,2,3,4];
arr.shift();  // ==> 1   ---> [2,3,4]
arr.shift(4); // ==> 2   ---> [3,4]

//reverse()  反转数组
var arr = [1,2,3,4];
arr.reverse();  // ==>[4,3,2,1]

//splice()  切片放法  (没有返回值)
var arr = [1,2,3,4];
arr.splice(2, 1);  // ==>[1,2,4]
//splice(从第几位开始, 截取多少长度, 在切口处添加新的数据)
arr.splice(1, 1, 9);  // ==> [1, 9, 4];
arr.splice(0, 0, 3);  // ==> [3, 1, 9, 4]

//sort()  数组排序
var arr = [1,2,10,4,5];
arr.sort();   // ==> [1,10,2,4,5]  针对ACII码排序，未能实现数字大小排序
//sort(function(a,b) {}) 必须传两个形参值 返回正数时，数组中a b 互换位置  返回负数和0时不动
arr.sort(function(a, b) {
         return a - b;   //升序排序  ==> [1, 2, 4, 5 ,10]
         return b - a;   //降序排序  ==> [10, 5, 4, 2, 1]
 });
```

#### b、不改变原数组

```javascript
//concat   数组拼接
var arr = [1,2,3];
var arr1 = [5,6,7];
console.log(arr.concat(ar1));   // ==> [1,2,3,5,6,7]
console.log(arr);   // ==> [1,2,3]

//join  将数组转换为字符串(默认为逗号相连)
var arr = [1,2,3];
console.log(arr.join(','));  // ==> "1，2，3"
console.log(arr.join('-'));  // ==> "1-2-3"
console.log(arr.join(''));  // ==> "123"

//split  与join 互逆
var arr = "1-2-3";
console.log(arr.split('-'));  // ==> ["1","2","3"]
```

###  （2）类数组：属性要为索引（数字）属性，必需有length属性，最好加上push

```javascript
var obj = {
    "2": "a",
    "3": "b",
    "length": 2,
    "push": Array.prototype.push
}
obj.push("c“);   // push 方法位置是由长度（length）决定
obj.push("d");
console.log(obj);   /*obj = {
    					"2": "c",
    					"3": "d",
    					"length": 4,
   						"push": Array.prototype.push
					}*/ 
```

##  19、es5.0的严格模式

`不在兼容es3.0的一些不规则语法`

> 启用方法:  "use  strict";    //字符串不会对不兼容严格模式的浏览器造成影响
>
> * 全局严格模式
> * 局部严格模式（推荐使用）
>
> 变量赋值前必须声明var
>
> 拒绝重复使用属性和参数
>
> 局部作用域预编译时this不在指向window，而是undefined，所以this必须被赋值

###  不支持的es3.0的语法

```javascript
//with   可改变作用域链，比较损耗浏览器内核 （可用于命名空间）
var name = 'window';
function test () {
    var name = 'test';
}
function fun () {
    var name = 'fun';
    with(test) {    //改变了作用域AO指向
         console.log(name);
    }
}
fun();   // ==> test   



//func.caller   获取调用者
//arguments.callee   获取当前函数的引用
```

##  20、DOM	

> ``节点类型``	元素节点1、属性节点2、文本节点3、注释节点8、document9、DocumentFragment11
>
> `获取节点类型`  nodeType
>
> `节点的四个属性`
>
> *  nodeName      返回大写的标签名，只能读
> * nodeValue        文本节点的内容
> * nodeType          节点类型
> * attributes           元素节点的属性集合
>
> `节点的一个方法`     noide.hasChildNodes();    有无子节点，返回true 或false

* dom节点树
  * parentNode  --> 父节点（最顶端的parentNode为#document）
  * childNodes  ---> 子节点们（元素节点、属性节点、文本节点、注释节点）
  * firstChild  -->  第一个子节点
  * lastChild  -->   最后一个子节点
  * nextSibling  -->  后一个兄弟节点
  * previousSibling  --->  前一个兄弟节点

* 遍历只有元素节点的节点树
  * parentElement    --->   返回当前父元素节点（IE不兼容）
  * children   -->   返回当前元素的元素子节点
  * ![节点](https://github.com/xiaoliuing/study-notes/blob/master/imgs/js/5.png?raw=true)

###  dom操作

>    增	
>
> ![dom操作](https://github.com/xiaoliuing/study-notes/blob/master/imgs/js/6.png?raw=true)

##  21、js与css

> * doc.style.xx     只能获取行间样式，添加样式模式也为行间样式
> * window.getComputedStyle(ele, null);   读取该元素的最终样式，只能读不能修改（IE8以下不兼容）

> 操作滚动条
>
> scroll(x, y)      scrollTo(x, y)      
>
> scrollBy(x, y);           能进行累加滚动
