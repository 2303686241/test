<?php

	function postback() {
		
		if(empty($_POST['name'])) {
			$GLOBALS['err_message'] = '请输入姓名';
			return ;
		}

		if(!(isset($_POST['gender']) && $_POST['gender'] !== -1)) {
			$GLOBALS['err_message'] = '请输入性别';
			return ;
		}

		if(empty($_POST['birthday'])) {
			$GLOBALS['err_message'] = '请输入生日';
			return ;
		}

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

		//存储数据
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$headerimg = '03/mysqli-project' . substr($target, 1);
		var_dump($name);
		var_dump($gender);
		var_dump($birthday);
		var_dump($headerimg);
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		postback();
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
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
    <h1 class="heading">添加用户</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" name="name">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" name="gender">
          <option value="1">男</option>
          <option value="0">女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" name="birthday">
      </div>
      <div class="form-group">
        <label for="avatar">头像</label>
        <input type="file" class="form-control" name="avatar">
      </div>
      <button class="btn btn-primary">保存</button>
    </form>
  </main>
</body>
</html>
