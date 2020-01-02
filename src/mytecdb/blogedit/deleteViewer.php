
<!doctype html>
<html>
<head>
	<?php include_once("../config.php") ?>
   	<?php include_once("../php/common.php") ?>
   	
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
	<link rel="stylesheet" href="../js/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="../js/kindeditor/plugins/code/prettify.css" />
	<script charset="UTF-8" src="../js/jquery.min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/kindeditor-all-min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="../js/kindeditor/plugins/code/prettify.js"></script>
	
<?php

	$param = $_SERVER["QUERY_STRING"];
	$arrParam = explode("=", $param);
	$blogID = $arrParam[1];
	
		
	if($blogID!="-1")
	{
		$config = "../config.php";
	$server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
  	$username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
  	$password=get_password();//($config, "password", "string") ; // 连接数据库密码 
  	$mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字

	$link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if(!$link) die("没有连接成功!");
    
    mysqli_query($link,"SET NAMES utf8");

	

    $q = "delete from blog where id=$blogID"; //SQL查询语句



    $rs = mysqli_query($link,$q); //获取数据集
    if(!$rs){die("Valid result!");}
	
	
  	mysqli_close($link);
    echo "delete blog:$blogID success!";
}


?>
</head>
<body>
</body>
</html>

