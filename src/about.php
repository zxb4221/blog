<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getGlobalData.php") ?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>关于我——若无闲事挂心头，便是人间好时节</title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  
  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css"/>
  <link href="css/theme.css" media="screen" rel="stylesheet" type="text/css"/>

</head>
<body>


  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
    </div>
    <div id="branding" class="clearfix">
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul>
        <li class="blog_navbar_for"><a href="index.php"><strong>最新文章</strong></a></li>
        <li><a href="contact.php">留言</a></li>
        <li><a href="about.php">关于我</a></li>
      </ul>

      <div id="fd"></div>         
    </div>
  </div>

    <div id="content" class="clearfix">
      <div id="main">
       <div class="blog_main_title">
        <span>自我介绍</span> 
        <div id="fd"></div>  
      </div>     


      <div class="about_main">



        <div id="blog_content" class="blog_content">
    <!-- <p>
              从最初刚出校门懵懂稚嫩的职场新人，到如今虽有几年江湖经验，但依旧觉得一无所知的职场老鸟，唯有不断的学习，不断的获得新知识、新想法，才能在快节奏的都市生活中，获得一丝安全感。
            </p>
          -->
          <p>学习知识，分享技术，不断成长。
          </p>
        </div>





      </div>
      <div class="blog_main_title">
        <span>联系方式</span> 
        <div></div>  
      </div>    
      <div class="about_main">
        <div class="blog_content">
          <p>QQ:1135371534</p>
          <p>Email:1135371534@qq.com</p>
        </div>
      </div>

      <div class="blog_main_title">
        <span>友情链接</span> 
        <div></div>  
      </div>    
      <div class="about_main">
        <div class="blog_content">
          <p><a href="http://vicfeel.cn/" target="_blank">六维记忆</a></p>
          <p><a href="http://blog.vicfeel.cn/" target="_blank">Vicfeel's Blog</a></p> 
        </div>
      </div>

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
</body></html>