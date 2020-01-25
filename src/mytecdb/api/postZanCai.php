<?php
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
$allow_origin = array(
    'http://www.mytecdb.com',
    'http://mytecdb.com'
);
  
if(in_array($origin, $allow_origin)){  
    header('Access-Control-Allow-Origin:'.$origin);       
} 

header('Content-Type:application/json; charset=utf-8');
include_once("../config.php");

if($_POST){
  
  if( !array_key_exists("blogId", $_POST) || !array_key_exists("type", $_POST)){
    $result = array('code'=>4,'message'=>"post param invalid!");
    exit(json_encode($result));
  }
  $blogId = $_POST["blogId"];
  $type = $_POST["type"];
  $ip = $_SERVER["REMOTE_ADDR"];

  

  if($type == "zan"){
    $q = "select id from zan where ip='$ip' and blog_id='$blogId' and ts > SUBDATE(now(),interval 5 minute)";
  }else if($type == "cai"){
    $q = "select id from cai where ip='$ip' and blog_id='$blogId' and ts > SUBDATE(now(),interval 5 minute)";
  }else{
    $result = array('code'=>5,'message'=>"param type($type) must be zan or cai!");
    exit(json_encode($result));
  }

  

  $server_name=get_server_name(); 
  $username=get_user_name();
  $password=get_password();
  $mysql_database=get_database();

  $link=mysqli_connect($server_name,$username,$password,$mysql_database);
  if(!$link){
    $result = array('code'=>2,'message'=>'can not connect to database!');
    exit(json_encode($result));
  }
    
  mysqli_query($link,"SET NAMES utf8");



  $rs = mysqli_query($link,$q); 
  if (mysqli_num_rows($rs) > 0){
    mysqli_close($link);
    $result = array('code'=>3,'message'=>"your ip($ip) $type many, please wait 5 minute.");
    exit(json_encode($result));
  }
  
  

  $blogId = str_replace("'", "\'", $blogId);
  $type = str_replace("'", "\'", $type);
  

  

  mysqli_query($link,"begin");

  if($type == "zan"){
    $q_i = "insert into zan(blog_id,ip,ts) values('$blogId','$ip',now())";
    $q_u = "update blog set zan_count=zan_count+1 where id='$blogId'";
  }else{
    $q_i = "insert into cai(blog_id,ip,ts) values('$blogId','$ip',now())";
    $q_u = "update blog set cai_count=cai_count+1 where id='$blogId'";
  }


  $rs = mysqli_query($link,$q_i);
  $rs = mysqli_query($link,$q_u);

  mysqli_query($link,"commit");

  mysqli_close($link);
    
  $result = array('code'=>0,'message'=>'suceessful');
  
    
}else{
  $result = array('code'=>1,'message'=>'post param is null!');
}


exit(json_encode($result));

?>
