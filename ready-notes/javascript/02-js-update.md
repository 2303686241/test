## js精髓

### 一、作用域

```javascript
(function test() {
    var a = b = 1;
    // var a = 1;  a被声明，所以被包含在test函数作用域里
    // b = 1;   b未被声明，就暴露给了全局
})();
console.log(a); // ==> a is not define
console.log(b); // ==> 1
```

### 二、闭包

```javascript
function test() {
    var a = 1;
    retrun function() {
        
    }
}
test(); // a会被回收，返回的函数没有对a的引用
		//但eval(),with(){}, try{}catch(){}不会释放对a的引用，window.eval()除外
```

### 三、this

```javascript
// (输出li里的内容)
<li>a</li><li>b</li><li>c</li><li>d</li><li>e</li>

var li_list = document.getElementByTagName("li");
for(var i = 0; i < li_list.length; i ++) {
    li_list[i].onclick = function() {
        console.log(this.innerHTML);
    }
}
```

### 四、es6、es5原型转换

```javascript
// es6
class test{
    var a = 12;
    constructor(name) {
		this.name = name;
    }
    say() {
        console.log(this.name);
    }
}

// es5
function test(name) {
    this.name = name;
}

test.prototype.a = 12;
test.prototype.say = function () {
    console.log(this.name);
}
```

### 五、函数的重载

```javascript
// 闭包  作用域  按地址引用传参   
function addMethod(object, name, fn) {
  var old = object[name];  // b 记录了上一次的函数值，old相当于指针
  object[name] = function() {
    if(fn.length == arguments.length) {
      return fn.apply(this, arguments);
    } else if(typeof old == "function") {
      return old.apply(this, arguments);  // d old指向上一个object[name]函数值
    }
  }
}

var person = ['xiaoliu', 'cs', 'add'];
// 
//a 初始化重载函数时，将find函数存到多个地址空间里，用old连接起来
addMethod(person, 'find', function() {
  return this.values;
})

addMethod(person, 'find', function(firstName) {
  return 1;
})

addMethod(person, 'find', function(firstName, lastName) {
  return 2;
})
// c 执行会从下往上遍历
person.find('xiaoliu');  // ==> 1
```

