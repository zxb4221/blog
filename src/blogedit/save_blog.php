
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
<?php
	$id=$_POST["blogID"];
	$author = "zxb";
	$blogTitle = $_POST["title"];
	$blogContent = $_POST["content"];
	
	echo $blogTitle;
	echo $blogContent;	
	echo $id;

	function getconfig($file, $ini, $type="string") 
	{ 
	if ($type=="int") 
	{ 
	$str = file_get_contents($file); 
	$config = preg_match("/" . $ini . "=(.*);/", $str, $res); 
	Return $res[1]; 
	} 
	else 
	{ 
	$str = file_get_contents($file); 
	$config = preg_match("/" . $ini . "=\"(.*)\";/", $str, $res); 
	if($res[1]==null) 
	{ 
	$config = preg_match("/" . $ini . "='(.*)';/", $str, $res); 
	} 
	Return $res[1]; 
	} 
	} 




	function updateconfig($file, $ini, $value,$type="string") 
	{ 
	$str = file_get_contents($file); 
	$str2=""; 
	if($type=="int") 
	{ 
	$str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=" . $value . ";", $str); 
	} 
	else 
	{ 
	$str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=\"" . $value . "\";",$str); 
	} 
	file_put_contents($file, $str2); 
	} 

	$config = "../config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string") ; // 连接数据库用户名 
	$password=getconfig($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

	$link=mysql_connect($server_name,$username,$password);
    if(!$link) echo "没有连接成功!";
    mysql_select_db($mysql_database, $link); //选择数据库
    mysql_query("SET NAMES utf8");
	
	//单引号转义
	$blogTitle = str_replace('\'', "''", $blogTitle);
	$blogContent = str_replace('\'', "''", $blogContent);
	$author = str_replace('\'', "''", $author);
	
	
	if($id == -1){
		$sql = "insert into blog(title, content, author, publishdate, modifydate) values('$blogTitle', '$blogContent', '$author', now(), now())";
		echo "-1";	
	}
	else
		$sql = "update blog set title='$blogTitle',content='$blogContent',author='$author',modifydate=now() where id=$id";
	
	mysql_query($sql); 

    
?>
</head>
<body>
	<p>save success!</p>
</body>
</html>


