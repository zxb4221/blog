<?php
header('Content-Type:application/json; charset=utf-8');
include_once("../config.php");

$server_name=get_server_name(); 
$username=get_user_name();
$password=get_password();
$mysql_database=get_database();

$result = array();


$link=mysqli_connect($server_name,$username,$password,$mysql_database);
if(!$link){
  $result = array('code'=>2,'message'=>'can not connect to database!');
  exit(json_encode($result));
}
  
mysqli_query($link,"SET NAMES utf8");
$q = "select user,ts,message from message order by ts desc limit 50";
$rs = mysqli_query($link,$q);
while($row = mysqli_fetch_row($rs)){
    $obj = array('user'=>(string)$row[0],'ts'=>(string)$row[1],'message'=>(string)$row[2]);
    array_push($result, $obj);
}

mysqli_close($link);

exit(json_encode($result));

?>
