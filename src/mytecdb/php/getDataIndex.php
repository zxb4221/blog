<?php
	
	$error = 0;
	$error_msg = "";
	$g_BlogCount=0;


	$currentPage=0;
    $countPerPage=10;

	$server_name=get_server_name();
	$username=get_user_name();
	$password=get_password();
	$mysql_database=get_database();
	
	$link=mysqli_connect($server_name,$username,$password,$mysql_database);

	if(!$link){
		$error = 1;
		$error_msg = "数据库连接失败!";
		return;
	}
    
    mysqli_query($link,"SET NAMES utf8");
	
	$type = -1;
	
	//分页
    
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
	       }
	       else{
	       	$error = 1;
			$error_msg = "invalid param $param!";
			return;
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
