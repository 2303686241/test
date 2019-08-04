## php面向对象编程

#### 1、面向对象编程概述

* OOP(Object-Oriented  Programming: 面向对象编程)代码更简洁、更易于维护、具有更强的可重用性。
* 三个目标：重用性、灵活性、扩展性。
* 特点：封装、继承、多态

#### 2、面向对象

> ???什么是类
>
> `类是面向对象程序设计中的一个概念，类可以说是具有相同属性和行为的一组对象的集合，也可以说是对某类型的对象定义属性和行为的原型。这种类型对象的个体实例就是对象，该实例对象具有继承了该类型对象的状态和行为。类是创建对象的蓝图。`
>
> ???如何抽象一个类
>
> ```php
> [修饰符] class 类名 {
>     [成员属性]  // 成员变量
>     [成员行为]  // 成员方法或函数
> }
> 
> // 成员行为
> [修饰符] function 方法名(参数...) {
>     [方法体]
>     [return [返回值]] 
> }
> ```
>
> ​	

**什么是对象？**

`对象就是类的实例，对象有三个特性，即：行为（函数）、状态（变量）、标识（实例对象的地址）`

**实例化对象**

```php
$对象名称 = new 类名称();
$对象名称 = new 类名称([参数列表]);
```

**访问对象的成员**

```php
$引用名 -> 成员属性 = 赋值;
$引用名 -> 成员方法(参数);
```

#### 3、面向对象编程示例

```php
<?php
class Person { // 类的声明
  public $name = 'liu'; // 成员属性

  public function say($name) { // 成员方法
    $this -> $name = $name;
    echo "she is {$this -> $name}";  // 欲输出$name，必须加双引号，单引号会识别为字符串
  }

  public function hello($val) { // 成员方法
    $this -> say($val);
  }
}

$person = new Person();  // $person为对象的标识
echo $person -> name; // 访问成员属性是，不加 $ 符
$person -> hello('xiaoliu');
?>
```

#### 4、php面向对象的封装

**&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;封装是面向对象编程的三大特性之一，封装就是把对象中的成员属性和成员方法加上访问修饰符，使其尽可能隐藏对象的内部细节，以达到队成员的访问控制。**

* 修饰符（protected，private 定义的方法和属性，外部不可直接访问）
  * public （共有的）
  * private （私有的）
  * protected （受保护的）
* 魔术方法 （**只针对private和protected修饰的成员属性**）
  * __set($key, \$val); -->  拦截对private和protected成员属性的修改，方便修改其属性
  * __get($key);  -->  拦截对private和protected成员属性的获取，方便得到其属性
  * __isset($key); -->  拦截对private和protected成员属性的isset判断，并返回结果
  * __unset($key); -->  拦截对private和protected成员属性的unset操作，并完成删除操作

```php
<?php
class Person {
  public $name = 'liu'; // 公有的
  private $age = 22; // 私有的
  protected $money = 1; // 受保护的

  public function getName() { // 公有的方法
    echo $this -> name;
  }
  private function getAge() { // 私有的方法
    echo $this -> age;
  }

  protected function getMoney() { // 受保护的方法
    echo $this -> money;
  }

  public function __set($key, $val) { // 拦截更改操作
    if($key === "age") {
      $this -> age = $val;
    }
  }

  public function __get($key) { // 拦截获取操作
    if($key === "age") {
      return $this -> age;
    }
  }

  public function __isset($key) { // 拦截isset操作
    if($key === "money") {
      return true;
    }
  }

  public function __unset($key) { // 拦截unset操作
    if($key === "age") {
      unset($this -> age);
    }
  }
}

$person = new Person();
$person -> age = 21;
echo isset($person -> money); // 1
var_dump(isset($person -> money)); // true
unset($person -> age);
echo $person -> age;
?>
```

