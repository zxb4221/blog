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
  
  if( !array_key_exists("blogId", $_POST) || !array_key_exists("user", $_POST) || !array_key_exists("message", $_POST)){
    $result = array('code'=>4,'message'=>"post param invalid!");
    exit(json_encode($result));
  }

  $blogId = $_POST["blogId"];
  $user = $_POST["user"];
  $message = $_POST["message"];
  $ip = $_SERVER["REMOTE_ADDR"];

  $user = str_replace("'", "\'", $user);
  $blogId = str_replace("'", "\'", $blogId);
  $message = str_replace("'", "\'", $message);
  $message = str_replace("\n", "<br>", $message);

  $q = "select id from comment where ip='$ip' and blog_id='$blogId' and ts > SUBDATE(now(),interval 5 minute)";
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
    $result = array('code'=>3,'message'=>"your ip($ip) post comment too many, please wait 5 minute.");
    exit(json_encode($result));
  }
  
  $q = "insert into comment(user,blog_id,message,ip,ts) values('$user','$blogId','$message','$ip',now())";
  $rs = mysqli_query($link,$q);
  mysqli_close($link);
    
  $result = array('code'=>0,'message'=>'suceessful');
  
    
}else{
  $result = array('code'=>1,'message'=>'post param is null!');
}


exit(json_encode($result));

?>
