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



$config = "./config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string") ; // 连接数据库用户名 
	$password=getconfig($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字
	
	$link=mysql_connect($server_name,$username,$password);

    if(!$link) echo "没有连接成功!";
    mysql_select_db($mysql_database, $link); //选择数据库
    mysql_query("SET NAMES utf8");

	//select a.id,b.count from blog a,blog_read_count b where a.id=b.blog_id and a.id=5;


    $q = "select id,title,modifydate,read_count from blog order by modifydate desc";
	


    $rs = mysql_query($q); //获取数据集

    echo "<div id=\"article_list\" class=\"contents\">";

    while($row = mysql_fetch_array($rs)){
		echo "<div class=\"list_item list_view\"><div class=\"article_title\"><span class=\"ico ico_type_Original\"></span><h1><span class=\"link_title\"><a href=\"blogDetail.php?id=";
		echo "$row[0]"; //链接文章ID		
		echo "\">";
		echo "$row[1]"; //显示title
		echo "</a></span></h1></div><div class=\"article_manage\"><span class=\"link_postdate\">";
		echo "$row[2]";	//显示日期
		echo "</span>" ;
		
		/*
		echo "<span class=\"link_view\" title=\"编辑\"><a href=\"/blogedit/editViewer.php?id=$row[0]\" title=\"编辑\">编辑</a></span><span class=\"link_view\" title=\"删除\"><a href=\"/blogedit/deleteViewer.php?id=$row[0]\" title=\"删除\">删除</a></span>";
		*/
		
		echo "<span class=\"link_view\" title=\"阅读次数\"><a href=\"blogDetail.php?id=$row[0]\" title=\"阅读次数\">阅读</a>($row[3])</span><span class=\"link_comments\" title=\"评论次数\"><a href=\"#\" title=\"评论次数\" onclick=\"_gaq.push(['_trackEvent','function', 'onclick', 'blog_articles_pinglun'])\">评论</a>(1)</span></div></div>";

	}
	echo "</div>";

    mysql_free_result($rs); //关闭数据集	
?>