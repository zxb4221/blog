  <?php include_once("../php/common.php") ?>
  <?php

 
  $config = "../config.php";
  $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
  $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
  $password=getconfig($config, "password", "string") ; // 连接数据库密码 
  $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

  $link=mysql_connect($server_name,$username,$password);
    if(!$link) echo "没有连接成功!";
  mysql_select_db($mysql_database, $link); //选择数据库
  mysql_query("SET NAMES utf8");

  $q = "SELECT visitdate,url FROM visit_trace order by visitdate desc"; //SQL查询语句



    $rs = mysql_query($q); //获取数据集
    if(!$rs){die("Valid result!");}

    
  	echo "<table>";
    while($row = mysql_fetch_array($rs)){
    echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
  }
  echo "</table>";
  mysql_free_result($rs); //关闭数据集



?>