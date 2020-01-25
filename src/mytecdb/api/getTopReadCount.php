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
$q = "select id,title,read_count from blog order by read_count desc limit 8";
$rs = mysqli_query($link,$q);
while($row = mysqli_fetch_row($rs)){
    $obj = array('id'=>(string)$row[0],'title'=>(string)$row[1],'read_count'=>(string)$row[2]);
    array_push($result, $obj);
}

mysqli_close($link);

exit(json_encode($result));

?>
