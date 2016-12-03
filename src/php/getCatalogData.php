<?php
$param = $_SERVER["QUERY_STRING"];
    if(!empty($param)){
      $arrParam = explode("=", $param);
      if($arrParam[0] != "typeID")
        die("invalid param $param!");

      $typeID = $arrParam[1];
      $pageTitle="最新文章";
      if(!empty($typeID)){

      
       $sqlTypeName="select name from blog_type where id=$typeID";
        $rs = mysql_query($sqlTypeName);
        while($row = mysql_fetch_array($rs)){
          $pageTitle="文章分类:$row[0]";

          break;
        }
    }
  }
  ?>