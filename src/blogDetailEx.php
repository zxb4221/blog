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


$config = "./config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string") ; // 连接数据库用户名 
	$password=getconfig($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

	$link=mysql_connect($server_name,$username,$password);
    if(!$link) echo "没有连接成功!";
    mysql_select_db($mysql_database, $link); //选择数据库
    mysql_query("SET NAMES utf8");



	

    $q = "SELECT title,modifydate,content FROM blog where id=$blogID"; //SQL查询语句



    $rs = mysql_query($q); //获取数据集
    if(!$rs){die("Valid result!");}

    
	
    while($row = mysql_fetch_array($rs)){
		echo "<article id=\"id-blogDetail\" class=\"detail_post\"><header class=\"article__title\"><h1 class=\"title\">";
		echo "$row[0]"; //显示title
		echo "</h1><p class=\"info\"><span class=\"nick\">NeverMore</span><span class=\"Separate\"> ·</span><span class=\"date\">";
		echo "$row[1]";	//显示日期
		echo "</span></p></header><div class=\"article__content\">";
		echo "$row[2]";	//显示内容
		echo "</div><footer class=\"article__footer\"><div class=\"meta article__meta\"><a href=\"#\" class=\"tag\"><!--i.fa.fa-tag--><span class=\"tag_name\">mysql</span></a><a href=\"#\" class=\"tag\"><!--i.fa.fa-tag--><span class=\"tag_name\">database</span></a><a href=\"#\" class=\"tag\"><!--i.fa.fa-tag--><span class=\"tag_name\">slow query</span></a><a href=\"/tag/btree\" class=\"tag\"><!--i.fa.fa-tag--><span class=\"tag_name\">btree</span></a><a href=\"#\" class=\"tag\"><!--i.fa.fa-tag--><span class=\"tag_name\">explain</span></a></div>
		<div class=\"qr_code_btn_container\">
		</div></footer></article>";
		break;
	}

    mysql_free_result($rs); //关闭数据集

    //文章阅读量增加
    $sql = "update blog set read_count=read_count+1 where id = $blogID";
    mysql_query($sql); //获取数据集

?>