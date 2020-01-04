<?php
header('Content-Type:application/json; charset=utf-8');
include_once("../config.php");

if($_POST){
  
  if( !array_key_exists("user", $_POST) || !array_key_exists("email", $_POST) || !array_key_exists("message", $_POST)){
    $result = array('code'=>4,'message'=>"post param invalid!");
    exit(json_encode($result));
  }
  $user = $_POST["user"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  $ip = $_SERVER["REMOTE_ADDR"];

  /*
  $needle ='<';
  if(count(explode($needle,$user))>1 || count(explode($needle,$email))>1 || count(explode($needle,$message))>1){
    $result = array('code'=>5,'message'=>"post param contains invalid character!");
    exit(json_encode($result));
  }*/

  $q = "select id from message where ip='$ip' and ts > SUBDATE(now(),interval 5 minute)";
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
    $result = array('code'=>3,'message'=>"your ip($ip) post message too many, please wait 5 minute.");
    exit(json_encode($result));
  }
  
  $q = "insert into message(user,email,message,ip,ts) values('$user','$email','$message','$ip',now())";
  $rs = mysqli_query($link,$q);
  mysqli_close($link);
    
  $result = array('code'=>0,'message'=>'suceessful');
  
    
}else{
  $result = array('code'=>1,'message'=>'post param is null!');
}


exit(json_encode($result));

?>
