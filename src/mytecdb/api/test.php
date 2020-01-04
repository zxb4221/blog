<?php
header('Content-Type:application/json; charset=utf-8');

$arr = array('a'=>1,'b'=>2);

exit(json_encode($arr));

?>
