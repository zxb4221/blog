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

$result = array('zanCount'=>'0','caiCount'=>'0','blogId'=>$blogID);


$link=mysqli_connect($server_name,$username,$password,$mysql_database);
if(!$link){
  $result = array('code'=>2,'message'=>'can not connect to database!');
  exit(json_encode($result));
}
  
mysqli_query($link,"SET NAMES utf8");
$q = "select zan_count,cai_count from blog where id='$blogID'";
$rs = mysqli_query($link,$q);
while($row = mysqli_fetch_row($rs)){
    $result = array('zanCount'=>(string)$row[0],'caiCount'=>(string)$row[1],'blogId'=>$blogID);
    break;
}

mysqli_close($link);

exit(json_encode($result));

?>
