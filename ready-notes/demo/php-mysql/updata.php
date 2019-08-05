<?php

	$connect = mysqli_connect('127.0.0.1', 'root', 'lx970112', 'mydb1');

	if($_SERVER['REQUEST_METHOD'] === 'GET') {

		if(!$_GET['id']) {
			exit('<h1>数据获取失败</h1>');
		}

		$query = mysqli_query($connect, "select * from users where id = {$_GET['id']}");

		if(!$query) {
			exit('<h1>数据查询失败</h1>');
		}

		$content = mysqli_fetch_assoc($query);
	}


	//数据更新
	function postfun() {
		if(empty($_POST['name'])) {
      $GLOBALS['err_message'] = '请输入姓名';
      return ;
    }

    if(!(isset($_POST['gender']) && $_POST['gender'] !== -1)) {
      $GLOBALS['err_message'] = '请输入性别';
      return ;
    }

    if(empty($_POST['birthday'])) {
      $GLOBALS['err_message'] = '请输入圣日';
      return ;
    }



    //图像文件上传
    if(empty($_FILES['avatar'])) {
      $GLOBALS['err_message'] = '请上传文件';
      return ;
    }

    $avatar = $_FILES['avatar'];

    if($avatar['error'] !== UPLOAD_ERR_OK) {
      $GLOBALS['err_message'] = '文件上传失败';
      return ;
    }

    $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
    $target = './uploads/' . uniqid() . '.' . $ext;
    if(!move_uploaded_file($avatar['tmp_name'], $target)) {
      $GLOBALS['err_message'] = '文件上传失败';
      return ;
    }



    //记下数据
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $headerimg = '/03/mysqli-project' . substr($target, 1);

    $connect = mysqli_connect('127.0.0.1', 'root', 'lx970112', 'mydb1');

    $query_updata = mysqli_query($connect, "update users set name = '{$name}', gender = {$gender}, birthday = '{$birthday}', avatar = '{$headerimg}' where id = {$_GET['id']};");

    if(!$query_updata) {
    	$GLOBALS['err_message'] = '查询数据失败';
      return ;
    }

    $updata_affected_num = mysqli_affected_rows($connect);

    if($updata_affected_num !== 1) {
    	$GLOBALS['err_message'] = '数据修改失败';
      return ;
    }

    header('Location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		postfun();
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
    <h1 class="heading">编辑用户(<?php echo $content['name']; ?>)</h1>
    <?php if (isset($err_message)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $err_message; ?>
      </div>
    <?php endif ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $content['id']; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" name="name" value="<?php echo $content['name']; ?>">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" name="gender">
          <option value="1" <?php echo $content['gender'] === '1' ? 'selected' : '' ; ?>>男</option>
          <option value="0" <?php echo $content['gender'] === '0' ? 'selected' : '' ; ?>>女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" name="birthday" value="<?php  echo $content['birthday']; ?>">
      </div>
      <div class="form-group">
        <label for="avatar">头像</label>
        <input type="file" class="form-control" name="avatar" >
      </div>
      <button class="btn btn-primary">保存</button>
      <a class="btn btn-danger" href="/03/mysqli-project/index.php">取消</a>
    </form>
  </main>
</body>
</html>
