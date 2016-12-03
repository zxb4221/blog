
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
	<link rel="stylesheet" href="../js/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="../js/kindeditor/plugins/code/prettify.css" />
	<script charset="UTF-8" src="../js/jquery.min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/kindeditor-all-min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="../js/kindeditor/plugins/code/prettify.js"></script>
	
<?php
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


	$param = $_SERVER["QUERY_STRING"];
	$arrParam = split("=", $param);
	$blogID = $arrParam[1];
	
		
	if($blogID!="-1")
	{
		$config = "../config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string") ; // 连接数据库用户名 
	$password=getconfig($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

	$link=mysql_connect($server_name,$username,$password);
    if(!$link) echo "没有连接成功!";
    mysql_select_db($mysql_database, $link); //选择数据库
    mysql_query("SET NAMES utf8");

	

    $q = "delete from blog where id=$blogID"; //SQL查询语句



    $rs = mysql_query($q); //获取数据集
    if(!$rs){die("Valid result!");}

    echo "delete blog:$blogID success!";
}


?>
</head>
<body>
</body>
</html>

