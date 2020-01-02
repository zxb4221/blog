
<!doctype html>
<html>
<head>
	<?php include_once("../config.php") ?>
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
<?php
	$id=$_POST["blogID"];
	$author = "zxb";
	$blogTitle = $_POST["title"];
	$blogContent = $_POST["content"];
	$blog_type_id = $_POST["blog_type"];

	echo $blogTitle;
	echo $blogContent;	
	echo "blog_id:$id<br/>";
	echo "blog_type_id:$blog_type_id";



	$config = "../config.php";
	$server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
  	$username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
  	$password=get_password();//($config, "password", "string") ; // 连接数据库密码 
  	$mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字

	$link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if(!$link) echo "没有连接成功!";
    $link->set_charset("utf8");
	
	//单引号转义
	$blogTitle = str_replace('\'', "''", $blogTitle);
	$blogContent = str_replace('\'', "''", $blogContent);
	$author = str_replace('\'', "''", $author);
	
	
	if($id == -1){
		$sql = "insert into blog(title, content, author, type_id, publishdate, modifydate) values('$blogTitle', '$blogContent', '$author', $blog_type_id, now(), now())";
		echo "-1";	
	}
	else
		$sql = "update blog set title='$blogTitle',content='$blogContent',author='$author', type_id=$blog_type_id, modifydate=now() where id=$id";
	
	$link->query("begin");
	$rs = $link->query($sql);
	$link->query("commit");
	$link->close();
    
?>
</head>
<body>
	<p>save success!</p>
</body>
</html>


