## es5补充

### 1、Object

* `Object.getPrototypeOf(obj)` --> 返回对象的原型，[[Prototype]]属性值

* `Object.getOwnPropertyDescriptor(obj, key)` -->得到该对象中的某个属性的描述符

  ````javascript
  o = { bar: 42 };
  d = Object.getOwnPropertyDescriptor(o, "bar");
  // d {    -->  属性描述符
  //   configurable: true,  当前属性可被删除、可被改变
  //   enumerable: true, 可被权举
  //   value: 42,  当前属性的值	
  //   writable: true  可改变
  // }
  
  ````

* `Object.getOwnPropertyNames(obj)`  --> 返回对象的所有自身属性的属性名

* `Object.create(obj.prototype)` --> 创建对象

* `Object.defineProperty(obj, prop, descriptor)` --> 给对象定义新属性，属性包含属性描述符

* `Object.defineProperties(obj, props)`  --> 给对象上定义新的属性或修改现有属性，可定义多个

* `Object.seal(obj)` --> 密封对象，只可读与改变已有属性的值

* `Object.freeze(obj)` --> 冻结对象，只可读

* `Object.isSealed(obj) ` --> 判断对象是否被密封

* `Object.isFrozen(obj)` --> 判断对象是否被冻结

* `Object.preventExtensions(obj)` --> 一个对象变的不可扩展，也就是永远不能再添加新的属性。

* `Object.isExtensible(obj)` --> 判断对象是否可扩展，密封、可以变和冻结的对象不可扩展

* `Object.keys(obj)` --> 遍历对象的键

* `Object.is(value1, value2)` --> 判断两个值是否相等，与

### 2、Array

* `Array.prototype.lastIndexOf(value, fromIndex[从哪开始找])` --> 返回指定元素在数组中的最后一个的索引,没有返回-1
* `Array.prototype.every(callback)` --> 测试一个数组内的所有元素是否都能通过callback函数的测试。它返回一个布尔值。
* ` Array.prototype.some(callback)` --> 测试至少有一个符合条件的数组。返回Boolean值
* `Array.prototype.filter()` --> 
* `Array.prototype.reduce(callback[Accumulator, CurrentValue, CurrentIndex, SourceArray]` --> 对数组中的每个元素执行一个由您提供的**reducer**函数
  * Accumulator (acc) (累计器)
  * Current Value (cur) (当前值)
  * Current Index (idx) (当前索引)
  * Source Array (src) (源数组)callback()
* `Array.prototype.reduceRight(callback)` -->  从右往左

### 3、按值传递、按引用传递

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**函数传参时，要避免按引用传递（objact，Array）, 引用传递的是对象或数组地址的引用，当在函数改变引用里的属性时，函数外的这个引用会被污染（改变），所以尽量使用按值传递。**

```javascript
function test(obj) {
    obj.num = 2;
    console.log(obj);
}
var obj = {
    name: 'xiaoliu'
}
test(obj); // ==> {name: 'xiaoliu', num: 2}
console.log(obj); // ==> {name: 'xiaoliu', num: 2}
```

