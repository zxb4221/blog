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


$blogID = $_SERVER["QUERY_STRING"];
if(!$blogID){
	$result = array('code'=>1,'message'=>'param is null!');
  	exit(json_encode($result));
}
$blogID = str_replace("'", "\'", $blogID);


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
$q = "select user,ts,message from comment where blog_id='$blogID' order by ts desc limit 50";
$rs = mysqli_query($link,$q);
while($row = mysqli_fetch_row($rs)){
    $obj = array('user'=>(string)$row[0],'ts'=>(string)$row[1],'message'=>(string)$row[2]);
    array_push($result, $obj);
}

mysqli_close($link);

exit(json_encode($result));

?>
