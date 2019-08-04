## php使用mysql数据库

#### 一、mysql

**mysql是一种在 Web 上使用的、服务器上运行的数据库系统**

####二、php与mysql数据库

##### 1、连接mysql

```javascript
<?php
$servername = "localhost";
$username = "username";
$password = "password";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";
?>
```

##### 2、数据库操作

```php+HTML
.........
    // 创建连接
    $conn = new mysqli("localhost", "username", "password", "database");
    // 检测连接
    if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
    } 

    // --创建数据库
    $sql = "CREATE DATABASE myDB";

	// --创建数据表
    $sql = "CREATE TABLE MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";
	
	// --插
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";
	
	// --查
	$sql = "SELECT id, firstname, lastname FROM MyGuests";

	// --改
	$sql = "UPDATE MyGuests SET Age=36
WHERE FirstName='Peter' AND LastName='Griffin'";

	// --删
	$sql = "DELETE FROM MyGuests WHERE LastName='Griffin'"
.........
```

