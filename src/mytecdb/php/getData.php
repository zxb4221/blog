<?php
	
	$g_VisitCount=0;
	$g_BlogCount=0;

	$g_BlogTypesName=array();
	$g_BlogTypesId=array();
	$g_BlogCountForType=array();
	$g_BlogTypeHtmlText="";

	
	$config = "config.php";
	$server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
	$username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
	$password=get_password();//($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字
	
	$link=mysqli_connect($server_name,$username,$password,$mysql_database);

	if(!$link) echo "没有连接成功!";
    
    mysqli_query($link,"SET NAMES utf8");


	$q = "select id,name from blog_type order by id desc";
    $rs = mysqli_query($link,$q); //获取数据集
    while($row = mysqli_fetch_row($rs)){
		array_push($g_BlogTypesId,(string)$row[0]);		
		array_push($g_BlogTypesName,(string)$row[1]);
	}


	foreach($g_BlogTypesId as $val)
	{
		$q = "select count(*) from blog where type_id=$val";
		$rs = mysqli_query($link,$q); //获取数据集
		while($row = mysqli_fetch_row($rs)){
			array_push($g_BlogCountForType,(int)$row[0]);
		}
	}

	
    for ($i= 0;$i< count($g_BlogTypesName); $i++){ 
      $g_BlogTypeHtmlText .="<li><a href=\"catalogViewer.php?typeID=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]($g_BlogCountForType[$i])</a></li>";
    }
	
	$type = -1;
	
	//分页
    $currentPage=0;
    $countPerPage=10;
    
	$param = $_SERVER["QUERY_STRING"];
    if(!empty($param)){
      $arrParam = explode("=", $param);
      
      while(count($arrParam)>=2){
      
	      if($arrParam[0] == "page"){
	        $currentPage = $arrParam[1];
	        
	        array_shift($arrParam);
	        array_shift($arrParam);
	       }elseif($arrParam[0] == "type"){
	       	$type = $arrParam[1];
	       	array_shift($arrParam);
	       	array_shift($arrParam);
	       }else{
	       	die("invalid param $param!");
	       }
	   }
    }
    
    if ($type == -1){
    	$q = "select count(*) from blog";
    }else{
    	$q = "select count(*) from blog where type_id=$type";
    }
    
    $rs = mysqli_query($link,$q); //获取数据集
    while($row = mysqli_fetch_row($rs)){
		$g_BlogCount=(int)$row[0]; //链接文章ID		
		break;
	}
    
    
    $allPageCount=ceil($g_BlogCount/$countPerPage);
	$countOffset=$currentPage*$countPerPage;
	
	if($currentPage >= $allPageCount)
		$currentPage=0;
	          
    mysqli_free_result($rs); //关闭数据集
    mysqli_close($link);

?>
