<?php

  $connect = mysqli_connect('127.0.0.1', 'root', 'lx970112', 'mydb1');

  if(!$connect) {
    exit('<h1>数据库连接失败!</h1>');
  }

  $tables_content = mysqli_query($connect, 'select * from users;');

  if(!$tables_content) {
    exit('<h1>数据查询失败!</h1>');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="<link href="https://cdn.bootcss.com/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXX管理系统</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">用户管理</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">商品管理</a>
      </li>
    </ul>
  </nav>
  <main class="container">
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="/03/mysqli-project/add.php">添加</a></h1>
    <table class="table table-hover">
      <thead  class="text-center">
        <tr>
          <th>#</th>
          <th>头像</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th width="140">操作</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php while ($content = mysqli_fetch_assoc($tables_content)) : ?>
        <tr>
          <th scope="row"><?php echo $content['id']; ?></th>
          <td><img src="<?php echo $content['avatar']; ?>" class="rounded" alt=""></td>
          <td><?php echo $content['name']; ?></td>
          <td><?php echo $content['gender'] == 0 ? '♀' : '♂' ; ?></td>
          <td><?php echo $content['birthday']; ?></td>
          <td class="text-center">
            <a class="btn btn-info btn-sm" href="/03/mysqli-project/updata.php?id=<?php echo $content['id']; ?>">编辑</a>
            <a class="btn btn-danger btn-sm" href="/03/mysqli-project/del.php?id=<?php echo $content['id']; ?>">删除</a>
          </td>
        </tr>
        <?php endwhile ?>
      </tbody>
    </table>
    <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
  </main>
</body>
</html>
