## es6（es2015）

#### 一、语法提案的批准流程

`任何人都能向标准委员会（TC39委员会）提案修改语言标准。一个提案只要能进入 Stage 2，就差不多肯定会包括在以后的正式标准里面。`

**一种新的语法从提案到成为正式标准，需要分五个阶段，每个阶段都需要由TC39委员会进行批准**

* Stage 0 --> 展示阶段
* Stage 1 --> 征求意见阶段
* Stage 2 --> 草案阶段
* Stage 3 --> 候选人阶段
* Stage 4 --> 定案阶段

#### 二、i不知道的es6

##### 1、数组array

* **Array.from(xx);** ==> 将类对象转换为数组（es5: Array.prototype.slice.call(xx)）

  * Array.from({length: 2});  -->  [undefined, undefined]

  * 第二个参数和map方法相似

    ```javascript
    Array.from([1, 2, 3], (x) => x * x)  ==> [1, 4, 9]
    ```

* **Array.of();** 弥补了Array的缺陷，Array传一个参数表示长度。Array.of()传啥就是啥，都存放在数组里

* **fill()**   -->  使用给定值填充数组

  ```javascript
  [1,3,4].fill(2); // ==> [2,2,2]
  
  // fill还有第二个（填充的起始位置）、第三个参数（填充的结束位置）
  [1,2,3].fill(5, 2, 3); // ==> [1, 2, 5]
  ```

* **entries()，keys() 和 values()**

  * `entries()`对键值对的遍历
  * `keys()`是对键名的遍历
  * `values()`是对键值的遍历

  ```javascript
  for (let index of ['a', 'b'].keys()) {
    console.log(index);
  }
  // 0 1
  for (let elem of ['a', 'b'].values()) {
    console.log(elem);
  }
  // 'a'  'b'
  
  for (let [index, elem] of ['a', 'b'].entries()) {
    console.log(index, elem);
  }
  // 0 "a"    1 "b"
  ```

* **flat()、flatMap()**
  * `flat()`拉平数组，传的值表示拉几层，默认为1，传Infinity则全部拉完
  *  `flatMap() `对原数组的每个成员执行一个函数，参数为函数，返回执行后的结果，并替换掉该成员

##### 2、对象

* 对象中的属性名可进行运算，也可以是一个变量的值

```javascript
let a = '11';
let obj = {
   [a]: '22',
   ['a'+2]: '33'
}
// ==> obj = {11: '22', a2: '33'}
```

* 对象属性名表达式不能为多个对象，因为会被转化为字符串“[object Object]”,前者会被覆盖掉

* **super**可继承原型对象的属性和方法，super只能用在对象的方法中

  ```javascript
  const proto = {
    x: 'hello',
    foo() {
      console.log(this.x);
    }
  };
  
  const obj = {
    x: 'world',
    find() {
      return super.foo();
    },
    run() {
      return super.x;  
    }
  };
  
  Object.setPrototypeOf(obj, proto); // 给obj添加proto原型对象
  obj.find() // "hello"
  obj.run() // "hello"
  ```

##### 3、class类

* class中可使用`getter`和`setter`来定义一个成员属性
* `super`关键字相当于    [父类名].prototype.constructor.call(this)

##### 4、Decorator 装饰器（装饰器只能用于类和类的方法，不能用于函数，因为存在函数提升。）

`装饰器（Decorator）是一种与类（class）相关的语法，用来注释或修改类和类方法。`

`装饰器是一种函数，写成@ + 函数名。它可以放在类和类方法的定义前面。`

* **类的装饰**

```javascript
@decorator   // decorator是一个函数
class A {}
// 等同于
class A {}
A = decorator(A) || A;

// ---给类原型添加属性--------------------
function testable(target) {
  target.prototype.isTestable = true;
}

@testable
class MyClass {}

let obj = new MyClass();
obj.isTestable // true
```

* **core-decorators.js**（第三方模块，提供了几个常见的装饰器，通过它可以更好地理解装饰器。）

  * `@autobind`装饰器使得方法中的`this`对象，绑定原始对象

  * `@readonly`装饰器使得属性或方法不可写。

  * `@override`装饰器检查子类的方法，是否正确覆盖了父类的同名方法，如果不正确会报错。
  * . . . . . . . . .

