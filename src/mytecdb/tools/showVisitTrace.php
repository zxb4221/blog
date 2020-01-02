  <?php include_once("../config.php") ?>
  <?php

  $server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
  $username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
  $password=get_password();//($config, "password", "string") ; // 连接数据库密码 
  $mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字

  $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if(!$link) {die("没有连接成功!");}
  mysqli_query($link,"SET NAMES utf8");

  $q = "SELECT visitdate,url FROM visit_trace order by visitdate desc"; //SQL查询语句



    $rs = mysqli_query($link,$q); //获取数据集
    if(!$rs){die("Valid result!");}

    
  	echo "<table>";
    while($row = mysqli_fetch_row($rs)){
    echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
  }
  echo "</table>";
  mysqli_close($link);

?>