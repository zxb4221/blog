<?php
	
	$g_VisitCount=0;
	$g_BlogCount=0;

	$g_BlogTypesName=array();
	$g_BlogTypesId=array();
	$g_BlogCountForType=array();
	$g_BlogTypeHtmlText="";

	
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
      $g_BlogTypeHtmlText .="<li><a href=\"catalogViewer.php?typeID=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]($g_BlogCountForType[$i])</a></li>";
    } 

    $param = $_SERVER["QUERY_STRING"];
    if(!empty($param)){
	    $arrParam = split("=", $param);
	    $typeID = $arrParam[1];
	    $pageTitle="最新文章";
	    if(!empty($typeID)){

	    
	     $sqlTypeName="select name from blog_type where id=$typeID";
	      $rs = mysql_query($sqlTypeName);
	      while($row = mysql_fetch_array($rs)){
	        $pageTitle="文章分类:$row[0]";

	        break;
	      }
	  }
	}

    mysql_free_result($rs); //关闭数据集


?>