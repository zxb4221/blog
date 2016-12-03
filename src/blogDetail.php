<html>
<head>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getGlobalData.php") ?>
  <?php

  $blogTitle="";
  $blogContent="";
  $blogDate="";

  $param = $_SERVER["QUERY_STRING"];
  $arrParam = explode("=", $param);
  $blogID = $arrParam[1];


  $config = "./config.php";
  $server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
  $username=getconfig($config, "username", "string") ; // 连接数据库用户名 
  $password=getconfig($config, "password", "string") ; // 连接数据库密码 
  $mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

  $link=mysqli_connect($server_name,$username,$password,$mysql_database);
  if(!$link) echo "没有连接成功!";
  $link->set_charset("utf8");

  $q = "SELECT a.title as title,a.publishdate as publishdate,a.content as content,a.read_count as read_count,a.type_id as type_id,b.name as name FROM blog as a,blog_type as b where a.id=$blogID and a.type_id=b.id"; //SQL查询语句


  $result = $link->query($q);
  if(!$result){die("Valid result!");}

    
  
    while($row = $result->fetch_assoc()){
    $blogTitle=(string)$row["title"];
    $blogDate=(string)$row["publishdate"];
    $blogContent = (string)$row["content"];
    $blogReadCount = $row["read_count"];
    $blogTypeId = $row["type_id"];
    $blogTypeName = $row["name"];
    break;
  }

 

    //文章阅读量增加
    $sql = "update blog set read_count=read_count+1 where id = $blogID";
    $result = $link->query($sql); //获取数据集


    //记录访问来源
    $ip = $_SERVER["REMOTE_ADDR"];
    if(isset($_SERVER['HTTP_REFERER'])){
      $url = $_SERVER['HTTP_REFERER'];
      if($url != ""){
        $sql = "insert into visit_trace(url,visitdate) values('$url($ip,$blogID)',now())";
        $result = $link->query($sql);
      }
    }

    $link->close();
    


?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title><?php echo "$blogTitle--若无闲事挂心头，便是人间好时节"; ?></title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  
  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css"/>
  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css"/>

  <script src="js/index.js" type="text/javascript" charset="utf-8"></script>



</head>
<body>
<?php include_once("baidu_js_push.php") ?>
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
          


<div class="blog_main">
  <div class="blog_title">
    <h2>
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
      <li>浏览(<?php echo $blogReadCount ?>)</li>
      <li><a href="#comments">评论(0)</a></li>
      
      
      <li>分类:<?php echo "<a href=\"catalogViewer.php?typeID=$blogTypeId\">$blogTypeName</a>" ?></li>      
     
    </ul>    
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
    声明：文章版权属于作者，受法律保护。若要转载，必须以超链接形式标明文章原始出处和作者。<br>
    © 2016-2016 www.matrix-binary.com.   All rights reserved.
  </div>
 
</div>
</div>
<div >
    <a href="javascript:window.smoothScrollToTop();"><span class="gototop"></span></a>
    </div>
</body></html>