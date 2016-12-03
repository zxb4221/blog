<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getGlobalData.php") ?>
  <?php
      $param = $_SERVER["QUERY_STRING"];
      if(!empty($param)){

        $config = "./config.php";
        $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
        $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
        $password=getconfig($config, "password", "string") ; // 连接数据库密码 
        $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

        $link=mysqli_connect($server_name,$username,$password,$mysql_database);
        if(!$link) echo "没有连接成功!";
        $link->set_charset("utf8");

        
        $arrParam = explode("=", $param);
        if($arrParam[0] != "typeID")
          die("invalid param $param!");

        $typeID = $arrParam[1];
        $pageTitle="最新文章";
        if(!empty($typeID)){

        
         $sqlTypeName="select name from blog_type where id=$typeID";
          $rs = $link->query($sqlTypeName);
          while($row = $rs->fetch_assoc()){
            $pageTitle="文章分类:$row[name]";

            break;
          }
        }
        $link->close();
      }
  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lucifer的博客——若无闲事挂心头，便是人间好时节</title>

  <meta name="keywords" content="技术博客,数据库,MySQL,Linux,Ubuntu,面试题" />
  <meta name="description" content="Lucifer的个人博客，分享知识，分享技术，记录学习、工作中的点点滴滴。" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css">
  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css">
  <script src="js/index.js" type="text/javascript" charset="utf-8"></script>


</head>
<body>
  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
   </div>
   <div id="branding" class="clearfix">
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul>
        <li class="blog_navbar_for"><a href="#"><strong>最新文章</strong></a></li>
        <li><a href="contact.php">留言</a></li>
        <li><a href="about.php">关于我</a></li>
      </ul>

      <div id="fd"></div>         
    </div>
  </div>

  <div id="content" class="clearfix">
    <div id="main">

      <div class="blog_main_title">
        <span><?php echo "$pageTitle" ?></span> 
        <div id="fd"></div>  
      </div>

      <?php

     

    $config = "./config.php";
    $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
    $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
    $password=getconfig($config, "password", "string") ; // 连接数据库密码 
    $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

    $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if(!$link) echo "没有连接成功!";
    $link->set_charset("utf8");




    $q = "select blog.id as id, blog.title as title, blog.publishdate as publishdate, blog.read_count as read_count, blog.content as content, blog_type.id as type_id, blog_type.name as name from blog,blog_type where blog.type_id=blog_type.id order by blog.publishdate desc";



    if(!empty($typeID)){
      $q = "select blog.id as id, blog.title as title, blog.publishdate as publishdate, blog.read_count as read_count, blog.content as content, blog_type.id as type_id, blog_type.name as name from blog,blog_type where blog.type_id=$typeID and blog.type_id=blog_type.id order by blog.publishdate desc";
    }

    


    $rs = $link->query($q); //获取数据集

    while($row = $rs->fetch_assoc()){

    $abstract = preg_replace ($search, $replace, $row["content"]);
    $abstract = substr_cn($abstract, 0, 200);
    $abstract .= "...";
    echo "<div class=\"blog_main\"><div class=\"blog_title\"><h3><a href=\"blogDetail.php?id=";
    echo "$row[id]"; //链接文章ID
    echo "\">";
    echo "$row[title]"; //显示title
    echo "</a></h3></div><div class=\"blog_content\">$abstract</div><div class=\"blog_bottom\"><ul><li class=\"date\">$row[publishdate]</li><li>浏览($row[read_count])</li><li><a href=\"#\">评论(0)</a></li><li>分类:<a style=\"margin-left:10px;\" href=\"catalogViewer.php?typeID=$row[type_id]\">$row[name]</a></li><li class=\"last\">标签:<a style=\"margin-left:10px;\" href=\"#\">MySQL</a><a style=\"margin-left:10px;\" href=\"#\">数据库</a><a style=\"margin-left:10px;\" href=\"#\">MySQL</a></li></ul></div></div>";

  }


  $link->close();
  ?>



<!--
  <div class="pagination"><span class="disabled prev_page">« 上一页</span> <span class="current">1</span> <a href="/?page=2" rel="next">2</a> <a href="/?page=3">3</a> <a href="/?page=4">4</a> <a href="/?page=2" class="next_page" rel="next">下一页 »</a></div>
  -->

</div>
<div id="local">
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
<div style="margin-top: 10px;float: left;clear: left;">
</div>
</div>    

<div id="footer" class="clearfix">
  <div id="copyright">
    <hr>
    声明：文章版权属于作者，受法律保护。若要转载，必须以超链接形式标明文章原始出处和作者。<br>
    © 2016-2016 www.matrix-binary.com.   All rights reserved.
  </div>
</div>
</div>
<div >
    <a href="javascript:window.smoothScrollToTop();"><span class="gototop"></span></a>
    </div>
</body></html>