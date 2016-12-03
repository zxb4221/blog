<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getData.php") ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title></title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
  
  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css"/>
  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css"/>

  
  <?php

  $blogTitle="";
  $blogContent="";
  $blogDate="";

  $param = $_SERVER["QUERY_STRING"];
  $arrParam = split("=", $param);
  $blogID = $arrParam[1];


  $config = "./config.php";
  $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
  $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
  $password=getconfig($config, "password", "string") ; // 连接数据库密码 
  $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

  $link=mysql_connect($server_name,$username,$password);
    if(!$link) echo "没有连接成功!";
    mysql_select_db($mysql_database, $link); //选择数据库
    mysql_query("SET NAMES utf8");



  

    $q = "SELECT title,modifydate,content FROM blog where id=$blogID"; //SQL查询语句



    $rs = mysql_query($q); //获取数据集
    if(!$rs){die("Valid result!");}

    
  
    while($row = mysql_fetch_array($rs)){
    $blogTitle=(string)$row[0];
    $blogDate=(string)$row[1];
    $blogContent = (string)$row[2];
    break;
  }

    mysql_free_result($rs); //关闭数据集

    //文章阅读量增加
    $sql = "update blog set read_count=read_count+1 where id = $blogID";
    mysql_query($sql); //获取数据集

?>


</head>
<body>

  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
   </div>
   <div id="branding" class="clearfix">
    <div id="blog_name">
      <h1><a href="/">若无闲事挂心头，便是人间好时节</a></h1>
    </div>
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul>
        <li class="blog_navbar_for"><a href="#"><strong>最新文章</strong></a></li>
        <li><a href="#">目录视图</a></li>
        <li><a href="#">分类视图</a></li>
        <li><a href="#">收藏</a></li>
        <li><a href="#">留言</a></li>
        <li><a href="about.php">关于我</a></li>
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
      <em class="actions">      </em>
    </h2>
        <div class="news_tag"><a href="#">MySQL</a>&nbsp;<a href="#">Linux</a>&nbsp;</div>
      </div>

  <div id="blog_content" class="blog_content">
    <?php echo "$blogContent"; ?>
  </div>
  

  <div class="blog_bottom">
    <ul>
      <li><?php echo "$blogDate"; ?></li>
      <li>浏览 9</li>
      <li><a href="#comments">评论(0)</a></li>
      
      
      <li>分类:<a href="http://www.iteye.com/blogs/category/language">编程语言</a></li>      
      <li class="last"><a href="http://www.iteye.com/wiki/blog/2315723" target="_blank" class="more">相关推荐</a></li>
    </ul>    
  </div>

      
  <div class="blog_comment">
    <h5>评论</h5>
    <a id="comments" name="comments"></a>
    
    
    
  </div>

  <div class="blog_comment">
    <h5>发表评论</h5>
            <p style="text-align:center; margin-top:30px;margin-bottom:0px;"><a href="/login" style="background-color:white;"> <img src="/images/login_icon.png" style="vertical-align:middle; margin-right: 10px;"></a><a href="/login">  您还没有登录,请您登录后再发表评论 </a></p>
      </div>
</div>

        </div>



<div id="local">
  <div class="local_top"></div>
  <div id="blog_owner">
    <div id="blog_owner_logo"><a href="/"><img alt="Lucifer的博客" class="logo" src="img/picture.jpg" title="Lucifer的博客: " width=""></a></div>
    <div id="blog_owner_name">Lucifer</div>
  </div>

  <div id="blog_actions">
    <ul>
      <li>阅读: <?php echo "$g_VisitCount"; ?></li>
      <li>性别: 男</li>
      <li>来自: 北京</li>
    </ul>
  </div>



  <div id="blog_menu">
    <h5>文章分类</h5>
    <ul>
      <li><a href="/">全部博客 (<?php echo "$g_BlogCount"; ?>)</a></li>
      <?php echo "$g_BlogTypeHtmlText"; ?>
    </ul>
  </div>
  <div id="month_blogs">
    <h5>社区版块</h5>
    <ul>
      <li><a href="#">我的资讯</a> (0)</li>
      <li>
        <a href="#">我的论坛</a> (2)
      </li>
      <li><a href="#">我的问答</a> (0)</li>
    </ul>
  </div>
  <div id="month_blogs">
    <h5>存档分类</h5>
    <ul>

      <li><a href="#">2016-08</a> (3)</li>

      <li><a href="#">更多存档...</a></li>
    </ul>
  </div>



  <div id="guest_books">
    <h5>最新评论</h5>
    <ul>

    </ul>
  </div>

  <div class="local_bottom"></div>

</div>
<div style="margin-top: 10px;float: left;clear: left;">
 
</div>
</div>    

<div id="footer" class="clearfix">
  <div id="copyright">
    <hr>
    声明：文章版权属于作者，受法律保护。没有作者书面许可不得转载。若作者同意转载，必须以超链接形式标明文章原始出处和作者。<br>
    © 2003-2016 www.matrix-binary.com.   All rights reserved.
  </div>
 
</div>
</div>
</body></html>