## php面向对象编程

#### 1、面向对象编程概述

* OOP(Object-Oriented  Programming: 面向对象编程)代码更简洁、更易于维护、具有更强的可重用性。
* 三个目标：重用性、灵活性、扩展性。
* 特点：封装、继承、多态

> 对象的多态性：指子类继承父类的属性和行为后，可具有不同的数据类型或表现不同的行为。这使得同一个属性或行为在父类及其字类中具有不同的语义。

#### 2、面向对象

**什么是对象？**

`对象就是类的实例，对象有三个特性，即：行为（函数）、状态（变量）、标识（实例对象的地址）`

> ???什么是类
>
> `类是面向对象程序设计中的一个概念，类可以说是具有相同属性和行为的一组对象的集合，也可以说是对某种类型的对象定义属性和行为的原型。这种类型对象的个体实例就是对象，该实例对象具有继承了该类型对象的状态和行为。类是创建对象的蓝图。`
>
> ???如何抽象一个类
>
> ```php
> [修饰符] class 类名 {
>  [成员属性]  // 成员变量
>  [成员行为]  // 成员方法或函数
> }
> 
> // 成员行为
> [修饰符] function 方法名(参数...) {
>  [方法体]
>  [return [返回值]] 
> }
> ```
>

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

#### 4、php类的构造方法（\__construct）和析构方法（__destruct）

```php
// 语法格式
[修饰符] function __construct ([参数]) {
    程序体
}
[修饰符] function __destruct ([参数]) {
    程序体
}

// 实例
<?php
class Person {
  public function __construct ($name) { // 构造方法
    // 该类被new时执行
    $this -> name = $name;
  }

  public function data() {
    echo $this -> name;
  }

  public function __destruct () { // 析构方法
    // 进行资源的释放操作 关闭数据库 对象别被销毁的时候执行，没有代码再去执行了
    echo "bye bye {$this -> name}";
  }
}

$person = new Person("xiaoliu");
$person -> data(); // ==> xiaoliubye bye xiaoliu
?>
```

#### 5、php面向对象的封装

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

#### 6、抽象类和接口

**1>、抽象类、抽象方法**

* 抽象方法：没有方法体、花括号，直接分号结束，用abstract关键自定义

  ```php
  public abstruct function();
  ```

* 抽象类：包含抽象方法并用abstract修饰的类

  * 特点：a、不能实例化（不能new）。b、使用抽象类就必须定义一个类去继承这个抽象类，并定义覆盖父类的抽象方法。

```php
<?php
  /*
   * 只有抽象类才能定义抽象方法，不一定要定义抽象方法，还可以是普通方法
   * 必须由一个子类继承，而且必须要全部实现抽象类的抽象方法
   */
  abstract class Person{
    // 抽象方法没有方法体
    public abstract function eat();
  }

  class Man extends Person {
    public function eat() {
      echo "man eat";
    }
  }

  $man = new Man();
  $man -> eat; // ==> "man eat"
?>
```



**2>、接口**

`php和大多数对象编辑语言一样，不支持多重继承，每个类只能继承一个父类。而接口可以解决这个问题，它指定了一个实现了该接口的类必须实现的一系列函数`

```php
// 定义格式
interface 接口名称{
    // 常量成员（使用const关键字定义）
    // 抽象方法（不需要使用abstract关键字）
}
// 使用格式
class 类名 implements 接口一，接口二{......}

// 实例
// 接口中声明的抽象方法不能用abstract定义
<?php
  interface Person {
    const NAME = 'xiaoliu'; // const声明常量
    public function fun();
    public function eat();
  }

  interface Study {
    public function study();
  }

  class Student implements Person, Study {
    const data = 3;  // 类定义常量，值不可变
    public function fun() {
      echo "fun";
    }
    public function eat() {
      echo "eat";
    }
    public function study() {
      echo "study";
    }
    public static function run() {
      echo "as" . self::data;
    }
  }

  $student = new Student();
  $student -> fun();   // ==> "fun
  echo $student::data; // ==> as3 （外部访问类的常量）
  echo $student::run();// ==> as3 （外部访问类的静态方法）
?>
```

**3>、抽象类和接口区别**

* 当关注**一个事物**的本质的时候，用抽象类; 当关注**一个操作**的时候，用接口
  * 接口是动物的抽象，表示这个对象能做什么，是对类的局部行为进行抽象
  * 抽象类是对根源的抽象，表示这个类是什么，对类的整体进行抽象，对一类事物的抽象描述
* 接口是抽象类的变体，接口所有的方法都是抽象的。而抽象类是声明方法的存在而不去实现它的类
* 接口可以多继承，抽象类不行
* 接口定义的方法，不能实现，而抽象类可以实现部分方法
* 接口的基本类型为static而抽象类不是
* 接口中不能含有静态代码块和静态方法，而抽象类可以含有静态代码块和静态方法

#### 7、常见关键字

**1>、final**

`用来修饰类和方法，不能修饰成员属性`

* 特性
  * final标识的类不能被继承
  * final声明的方法不能被覆盖
* 目的
  * 为了安全
  * 没必要被继承或重写

**2>、static**

`用于修饰类的成员属性和方法（即静态方法和1静态属性）`

* 类中的静态属性和方法不需实例化就可直接用类名访问

```php
类名::$静态属性
类名::静态方法
```

* 在类的方法中，不能用$this来引用静态方法和静态属性，而需要self

```php
self::$静态属性
self::静态方法
```

* 静态方法中不能使用非静态的内容，即不能使用$this
* 静态属性是共享的，也就是说new很多对象时也是公用一个属性

**3>、const**

`const是在类和接口中定义常量的关键字`

```php
const DATA = 'xiaoliu';
echo self::DATA;      // 类中访问
echo className::DATA; // 类外部访问
```

**4>、instanceof**

`用于检测当前对象实例是否属于某一类或这个类的子类`

> ----php中当new的类不存在时，会自动调用__autoload()，并将类名作为参数传你如此函数。可用这个实现类的自动加载。------------------------------------------------------
>
> ```php
> function __autoload($className) {
>     require_once  $className . ".php";
> }
> 
> $obj1 = new Class1(); // Class1 不存在，会自动调用__autoload()函数，Class1做参数
> ```
>
> ----补充__sleep()和\_\_wakeup()魔术方法------------------------------------
>
> `当对一个对象序列化时，php就会调用__sleep方法（如果存在的话），在反序列化时，php就会调用__wakeup方法（如果存在的话）。__sleep这个方法可以用于清理对象，并返回一个包含对象中所有变量名称的数组。如果该方法不返回任何内容，则NULL被序列化，导致一个E_NOTICE错误。在反序列化unserialize时，会检查是否存在__wakeup方法，如果存在，则会调用__wakeup方法，预先准备对象数据。`
>
> ```php
> <?php
> class user {
>     public $name;
>     public $id;
> 
>     function __construct() {    // 给id成员赋一个uniq id
>         $this->id = 123;
>     }
> 
>     function __sleep() {       //此处不串行化id成员
>         return(array('name'));
>     }
> 
>     function __wakeup() {
>         $this->id = 456;
>     }
> }
> 
> $u = new user();
> $u->name = "Leo";
> $s = serialize($u); //serialize串行化对象u，此处不串行化id属性，id值被抛弃
> $u2 = unserialize($s); //unserialize反串行化，id值被重新赋值
> 
> print_r($u);
> print_r($u2);
> ?>
> ```

