<?php include_once("../php/common.php") ?>
<?php
    $g_GlobalInfo=array("visitCount"=>0,    //访问数量 
                        "blogCount"=>0);    //博客文章数量

	$g_VisitCount=0;	//访问总量
	$g_BlogCount=0;		//文章数量 

	$g_BlogTypesName=array();
	$g_BlogTypesId=array();
	$g_BlogCountForType=array();


	$g_BlogTypeHtmlText="";

	
	$config = "../config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string"); // 连接数据库用户名 
	$password=getconfig($config, "password", "string"); // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string"); // 数据库的名字
	
	$link=mysqli_connect($server_name,$username,$password,$mysql_database);
	if (mysqli_connect_errno($link)) 
	{ 
	    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 


    $q = "select sum(read_count) as all_read_count from blog";
    $result = $link->query($q);
    while($row = $result->fetch_assoc()){
		$g_GlobalInfo["visitCount"] = (int)$row["all_read_count"]; //链接文章ID		
		break;
	}
    

	$q = "select count(*) as all_blog_count from blog";
    $result = $link->query($q); //获取数据集
    while($row = $result->fetch_assoc()){
		$g_GlobalInfo["blogCount"] = (int)$row["all_blog_count"];
        break;
	}
    $result->free();

    /*
	$q = "select id,name from blog_type";
    $result = $link->query($q); //获取数据集
    while($row = $result->fetch_assoc()){
		array_push($g_BlogTypesId,(string)$row[0]);		
		array_push($g_BlogTypesName,(string)$row[1]);
	}
    $result->free();
	*/


    /*
	foreach($g_BlogTypesId as $val)
	{
		$q = "select count(*) from blog where type_id=$val";
		$result = $link->query($q); //获取数据集
		while($row = $result->fetch_assoc()){
			array_push($g_BlogCountForType,(int)$row[0]);
		}
        $result->free();
	}
    */


	/*
    for ($i= 0;$i< count($g_BlogTypesName); $i++){ 
      $g_BlogTypeHtmlText .="<li><a href=\"catalogViewer.php?typeID=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]($g_BlogCountForType[$i])</a></li>";
    }
    */
     $link->close();
    

    echo json_encode($g_GlobalInfo);

?>
