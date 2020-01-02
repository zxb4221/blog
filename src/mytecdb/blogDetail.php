<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("config.php") ?>

  <?php

  $blogTitle="";
  $blogContent="";
  $blogDate="";

  $param = $_SERVER["QUERY_STRING"];
  $arrParam = explode("=", $param);
  $blogID = $arrParam[1];


  $config = "./config.php";
  $server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
  $username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
  $password=get_password();//($config, "password", "string") ; // 连接数据库密码 
  $mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字

  $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if(!$link) {die("没有连接成功!");}
    
    mysqli_query($link,"SET NAMES utf8");



  

    $q = "SELECT title,modifydate,content,read_count,name FROM blog,blog_type where blog.type_id=blog_type.id and blog.id=$blogID"; //SQL查询语句



    $rs = mysqli_query($link,$q); //获取数据集
    if(!$rs){die("Valid result!");}

    
  
    while($row = mysqli_fetch_row($rs)){
    $blogTitle=(string)$row[0];
    $blogDate=(string)$row[1];
    $blogContent = (string)$row[2];
    $read_count = (string)$row[3];
    $blog_type = (string)$row[4];
    break;
  }

    mysqli_free_result($rs); //关闭数据集

    //文章阅读量增加
    $sql = "update blog set read_count=read_count+1 where id = $blogID";
    mysqli_query($link,$sql); //获取数据集
    
    
    //记录访问来源
    $ip = $_SERVER["REMOTE_ADDR"];
    $sql = "insert into visit_trace(url,visitdate) values('($ip,$blogTitle)',now())";
    if(isset($_SERVER['HTTP_REFERER'])){
      $url = $_SERVER['HTTP_REFERER'];
      if($url != ""){
        $sql = "insert into visit_trace(url,visitdate) values('$url($ip,$blogTitle)',now())";
      }
    }
    mysqli_query($link,$sql);
    
    
    mysqli_close($link);
?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title><?php echo "$blogTitle-mytecdb"; ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  
  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css"/>

</head>
<body>

  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
   </div>
   <div id="branding" class="clearfix">
    <div id="blog_name">
      <h1><a href="/">welcome to my technology database</a></h1>
    </div>
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul>
        <li class="blog_navbar_for"><a href="#"><strong>最新文章</strong></a></li>
      </ul>

      <div id="fd"></div>         
    </div>
  </div>

  <div id="content" class="clearfix">
    <div id="main">
          


<div class="blog_main">
  <div class="blog_title">
    <h2 style="color:#108AC6;">
      <?php echo "$blogTitle"; ?>
      <em class="actions"></em>
    </h2>
    	
        <div class="news_tag"><a href="#"><?php echo "$blog_type"; ?></a>&nbsp;</div>
       
      </div>

  <div id="blog_content" class="blog_content">
    <?php echo "$blogContent"; ?>
  </div>
  

  <div class="blog_bottom">
    <ul>
      <li><?php echo "$blogDate"; ?></li>
      <li><?php echo "浏览 $read_count"; ?></li>
    
    </ul>    
  </div>  
      
</div>
</div>



<div style="margin-top: 10px;float: left;clear: left;">
 
</div>
</div>    

<div id="footer" class="clearfix">
  <div id="copyright">
    <hr>
    声明：本站发布的信息，版权属于作者，受法律保护，若有侵权，请联系站长删除。<br>
    © 2019-2020 www.mytecdb.com.   All rights reserved.
  </div>
 
</div>
</div>
</body></html>