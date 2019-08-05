<?php


	$connect = mysqli_connect('127.0.0.1', 'root', 'lx970112', 'mydb1');

	if(!$connect) {
		exit('<h1>数据库连接失败！</h1>');
	}

	$tables_content = mysqli_query($connect, 'delete from users where id = ' . $_GET['id']);

	$rows_num = mysqli_affected_rows($connect);
	if(rows_num === 0) {
		exit('<h1>删除失败!</h1>');
	} else {
		header('Location: index.php');
	}