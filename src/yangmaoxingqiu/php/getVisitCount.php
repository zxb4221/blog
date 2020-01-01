<?php
	
	$g_VisitCount=0;
	$g_BlogCount=0;

	$g_BlogTypesName=array();
	$g_BlogTypesId=array();
	$g_BlogCountForType=array();
	$g_BlogTypeHtmlText="";

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

    $q = "select sum(read_count) from blog";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
		$g_VisitCount=(int)$row[0]; //链接文章ID		
		break;
	}

	$q = "select count(*) from blog";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
		$g_BlogCount=(int)$row[0]; //链接文章ID		
		break;
	}

	$q = "select id,name from blog_type";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
		array_push($g_BlogTypesId,(string)$row[0]);		
		array_push($g_BlogTypesName,(string)$row[1]);
	}


	foreach($g_BlogTypesId as $val)
	{
		$q = "select count(*) from blog where type_id=$val";
		$rs = mysql_query($q); //获取数据集
		while($row = mysql_fetch_array($rs)){
			array_push($g_BlogCountForType,(int)$row[0]);
		}
	}

	
    for ($i= 0;$i< count($g_BlogTypesName); $i++){ 
      $g_BlogTypeHtmlText .="<li><a href=\"#\">$g_BlogTypesName[$i]($g_BlogCountForType[$i])</a></li>";
    } 

    mysql_free_result($rs); //关闭数据集


?>