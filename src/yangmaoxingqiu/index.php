<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("config.php") ?>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getData.php") ?>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  

  <meta name="keywords" content="薅羊毛,网赚,赚钱,分享" />
  <meta name="description" content="羊毛星球，分享最新、最热、最赚钱的羊毛" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css">
  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css">


  <title><?php echo get_title(); ?></title>

</head>
<body>
  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
   </div>
   <div id="branding" class="clearfix">
    <div id="blog_name">
      <h1><a href="/">羊毛星球，薅羊毛，薅最新、最热、最赚钱的羊毛~</a></h1>
    </div>
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul>
        <li class="blog_navbar_for"><a href="#"><strong>最新羊毛</strong></a></li>
        <!--
        <li><a href="#">目录视图</a></li>
        <li><a href="#">分类视图</a></li>
        <li><a href="#">收藏</a></li>
        <li><a href="#">留言</a></li>
        <li><a href="about.php">关于我</a></li>
        -->
      </ul>

      <div id="fd"></div>         
    </div>
  </div>

  <div id="content" class="clearfix">
    <div id="main">

      <div class="blog_main_title">
        <span>最新羊毛</span> 
        <div id="fd"></div>  
      </div>

      <?php

      

    $config = "config.php";
    $server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
    $username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
    $password=get_password();//($config, "password", "string") ; // 连接数据库密码 
    $mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字
    
    $error_level = error_reporting(0);
    $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    error_reporting($error_level);

    if(!$link) {die("没有连接成功!");}
  
    mysqli_query($link,"SET NAMES utf8");


    

    $q = "select blog.id,blog.title,blog.modifydate,blog.read_count,blog.content,blog_type.id,blog_type.name from blog,blog_type where blog.type_id=blog_type.id order by blog.modifydate desc";



    $rs = mysqli_query($link,$q); //获取数据集
    while($row = mysqli_fetch_row($rs)){
    $abstract = preg_replace_callback($search, function ($matches) {
            return "";
        }, $row[4]);
    $abstract = substr_cn($abstract, 0, 200);
    $abstract .= "...";
    echo "<div class=\"blog_main\"><div class=\"blog_title\"><h3><a href=\"blogDetail.php?id=";
    echo "$row[0]"; //链接文章ID
    echo "\">";
    echo "$row[1]"; //显示title
    echo "</a></h3></div><div class=\"blog_content\">$abstract</div><div class=\"blog_bottom\"><ul><li class=\"date\">$row[2]</li><li>浏览($row[3])</li> <!-- <li><a href=\"#\">评论(0)</a></li> --> <li>分类:<a style=\"margin-left:10px;\" href=\"#\">$row[6]</a></li> <!-- <li class=\"last\">标签:<a style=\"margin-left:10px;\" href=\"#\">MySQL</a><a style=\"margin-left:10px;\" href=\"#\">数据库</a><a style=\"margin-left:10px;\" href=\"#\">MySQL</a></li> --> </ul></div></div>";

  }


  mysqli_free_result($rs); //关闭数据集 
  mysqli_close($link);

  ?>

  <!--
  <div class="pagination"><span class="disabled prev_page">« 上一页</span> <span class="current">1</span> <a href="#" rel="next">2</a> <a href="#">3</a> <a href="/?page=4">4</a> <a href="#" class="next_page" rel="next">下一页 »</a></div>
  -->

</div>

<div style="margin-top: 10px;float: left;clear: left;">
 <ins data-revive-zoneid="185" data-revive-id="8c38e720de1c90a6f6ff52f3f89c4d57"></ins>
</div>
</div>    

<div id="footer" class="clearfix">
  <div id="copyright">
    <hr>
    声明：本站发布的信息，版权属于作者，受法律保护，若有侵权，请联系站长。<br>
    © 2019-2020 www.yangmaoxingqiu.top.   All rights reserved.
  </div>
  <ins data-revive-zoneid="186" data-revive-id="8c38e720de1c90a6f6ff52f3f89c4d57"></ins>
</div>
</div>



<div id="local" style="display: none;">
  <div class="local_top"></div>
  <div id="blog_owner">
    <div id="blog_owner_logo"><a href="/"><img alt="Lucifer的博客" class="logo" src="img/picture.jpg" title="Lucifer的博客" width=""></a></div>
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


</body></html>
