<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getGlobalData.php") ?>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  

  <meta name="keywords" content="技术博客,数据库,MySQL,Linux,Ubuntu,面试题" />
  <meta name="description" content="Lucifer的个人博客，分享知识，分享技术，记录学习、工作中的点点滴滴。" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css">
  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css">
  

  <script src="js/index.js" type="text/javascript" charset="utf-8"></script>

  <title>Lucifer的博客——若无闲事挂心头，便是人间好时节</title>

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
        <span>最新文章</span> 
        <div id="fd"></div>  
      </div>

      <?php

    //分页
    $countPerPage=12;
    $allPageCount=ceil($g_BlogCount/$countPerPage);
    $currentPage=0;


    $param = $_SERVER["QUERY_STRING"];
    if(!empty($param)){
      $arrParam = explode("=", $param);
      if($arrParam[0] != "page")
        die("invalid param $param!");
        $currentPage = $arrParam[1];
        if($currentPage >= $allPageCount)
          $currentPage=0;
        
    }

    $countOffset=$currentPage*$countPerPage;
    

    $config = "./config.php";
    $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
    $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
    $password=getconfig($config, "password", "string") ; // 连接数据库密码 
    $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

    $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    if (mysqli_connect_errno($link)) 
    { 
      echo "连接 MySQL 失败: " . mysqli_connect_error(); 
    }
    $link->set_charset("utf8");
    //if(!$link) echo "没有连接成功!";
    //mysql_select_db($mysql_database, $link); //选择数据库
    //mysql_query("SET NAMES utf8");


    

    $q = "select blog.id as id,blog.title as title, blog.publishdate as publishdate,blog.read_count as blog_read_count,blog.content as content,blog_type.id as typeId, blog_type.name as typeName from blog,blog_type where blog.type_id=blog_type.id order by blog.publishdate desc limit $countOffset,$countPerPage";



    $result = $link->query($q); //获取数据集

    while($row = $result->fetch_assoc()){

    $abstract = preg_replace ($search, $replace, $row["content"]);
    $abstract = substr_cn($abstract, 0, 200);
    $abstract .= "...";
    echo "<div class=\"blog_main\"><div class=\"blog_title\"><h3><a href=\"blogDetail.php?id=";
    echo "$row[id]"; //链接文章ID
    echo "\">";
    echo "$row[title]"; //显示title
    echo "</a></h3></div><div class=\"blog_content\">$abstract</div><div class=\"blog_bottom\"><ul><li class=\"date\">$row[publishdate]</li><li>浏览($row[blog_read_count])</li><li><a href=\"#\">评论(0)</a></li><li>分类:<a style=\"margin-left:10px;\" href=\"catalogViewer.php?typeID=$row[typeId]\">$row[typeName]</a></li><li class=\"last\">标签:<a style=\"margin-left:10px;\" href=\"#\">MySQL</a><a style=\"margin-left:10px;\" href=\"#\">数据库</a><a style=\"margin-left:10px;\" href=\"#\">MySQL</a></li></ul></div></div>";

  }
  //mysql_free_result($rs); //关闭数据集 

  if($allPageCount > 1){
    echo "<div class=\"pagination\">";

    $prevPage=$currentPage-1;
     if($currentPage == 0){
     echo "<span class=\"disabled prev_page\" rel=\"prev\">« 上一页</span>";
    }
    else{
      echo "<a href=\"/?page=$prevPage\" class=\"prev_page\" rel=\"prev\">« 上一页</a>";
    }


    

    if($currentPage-2 >= 0){
      $currentPageShow = $currentPage-2+1;
      $prevPage=$currentPage-2;
      echo "<a href=\"/?page=$prevPage\" rel=\"prev\">$currentPageShow</a>";
    }
    if($currentPage-1 >= 0){
      $currentPageShow = $currentPage-1+1;
      $prevPage=$currentPage-1;
      echo "<a href=\"/?page=$prevPage\" rel=\"prev\">$currentPageShow</a>";
    }
    $currentPageShow = $currentPage+1;
    echo "<span class=\"current\">$currentPageShow</span>";
    if($currentPage+1 < $allPageCount){
      $nextPage=$currentPage+1;
      $currentPageShow = $currentPage+1+1;
      echo "<a href=\"/?page=$nextPage\" rel=\"next\">$currentPageShow</a>";
    }
    if($currentPage+2 < $allPageCount){
      $nextPage=$currentPage+2;
      $currentPageShow = $currentPage+2+1;
      echo "<a href=\"/?page=$nextPage\" rel=\"next\">$currentPageShow</a>";
    }

    $nextPage=$currentPage+1;
    if($currentPage+1 >= $allPageCount){
       echo "<span class=\"disabled next_page\" rel=\"next\">下一页 »</span>";
    }
    else{
      echo "<a href=\"/?page=$nextPage\" class=\"next_page\" rel=\"next\">下一页 »</a>";
    }
    echo "</div>";
  }
  

  ?>

</div>
<div id="local">
  <div class="local_top"></div>
  <div id="blog_owner">
    <div id="blog_owner_logo"><a href="/"><img alt="Lucifer的博客" class="logo" src="img/picture.jpg" title="Lucifer的博客" width=""></a></div>
  </div>

  <div id="blog_actions">
    <ul>
      <li>作者: Lucifer</li>
      <li>性别: 男</li>
      <li>来自: 北京</li>
      <li>阅读: <?php echo "$g_VisitCount"; ?></li>
    </ul>
  </div>



  <div id="blog_menu">
    <h5>文章分类</h5>
    <ul>
      <li><a href="/">全部博客 (<?php echo "$g_BlogCount"; ?>)</a></li>
      <?php echo "$g_BlogTypeHtmlText"; ?>
    </ul>
  </div>
  <div id="AboutMe">
    <h5>关于我</h5>
    <ul>
      <li><a href="about.php">关于我</a></li>
      <li><a href="contact.php">留言薄</a></li>
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
