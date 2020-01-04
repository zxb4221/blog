<html><head>
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

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="keywords" content="database,mysql,linux,percona,数据库" />
  <meta name="description" content="database,mysql,linux,percona" />

<title><?php echo "$blogTitle-mytecdb"; ?></title>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

<!--顶部导航-->
<div class="page-title-fixed">
	<div class="container">
		<h1 class="logo">
			<a href="index.php">
				<span class="logo-name">mytecdb.com</span>
			</a>
		</h1>
		<ul class="page-menus">
			<li>
				<a href="index.php" class="active">最新文章</a>
			</li>
			<li>
				<a href="javascript:;">MySQL</a>
			</li>
			<li>
				<a href="javascript:;">PostgreSQL</a>
			</li>
			<li>
				<a href="javascript:;">Oracle</a>
			</li>
			<li>
				<a href="javascript:;">Linux</a>
			</li>
			<li>
				<a href="postMessage.html">Message</a>
			</li>
		</ul>
	</div>
</div>
<!--内容-->
<div class="wrapper">
	<div class="container">
		<div class="sidebar-wrapper fixed">
			<div class="sidebar" style="height: 428px;">
				<ul class="menu-group">
					<li class="menu-item menu-item-1 active">
						<a class=" sub-title" href="javascript:;">MySQL</a>
						<ul>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=4">MySQL安装</a>
							</li>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=7">MySQL升级</a>
							</li>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=9">MySQL优化</a>
							</li>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=10">MySQL死锁</a>
							</li>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=5">MySQL相关工具</a>
							</li>
							<li class="menu-item menu-item-2">
								<a href="index.php?type=6">MySQL Bug</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div class="main-container">

			<div class="markdown">

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
		</div>
	</div>
	
	<!--图片弹窗-->
	<div class="imgtc" style="display: none;">
		<img src="">
	</div>
	
</div>

<script src="js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(function() {
		//左侧菜单
		var h = 0;
		$('.menu-item-1 .sub-title').click(function() {
			$(this).parent().toggleClass('active collapse');
			$('.menu-item-1').each(function() {
				h += $(this).height();
			})
			//给菜单赋值高度
			$('.sidebar').css({
				"height": h
			});
			h = 0;
		})
		//右上角鼠标悬浮触发下拉
		$('.dropdown-toc').hover(function() {
			$('.dropdown-body').toggle();
		})
		//滚动监听
		var leg = $('.maodian').length;
		$(window).scroll(function() {
			$('.imgtc').hide(); //滚动后图片放大隐藏
			var sh = $(window).scrollTop()
			//右上悬浮
			sh > 86 ? $('.anchor-toc').addClass('fixed') : $('.anchor-toc').removeClass('fixed');
			//循环遍历锚点
			for(i = 1; i <= leg; i++) {
				if($("#mao" + i).offset().top-140 <= sh) {
					$('.maodian').removeClass('active');
					$('#mao' + i).addClass("active");
					$('.toc-current').text($('#mao'+i).parent().text());
					$('.dropdown-body ul li').removeClass('active').eq(i-1).addClass('active');
				}
				
			}
			sh < 140?$('.toc-current').text("本页导航"):"";
		})
		//右上角点击
		$('.dropdown-body ul li').click(function(){
			var jt = $(this).index();
			$(window).scrollTop($('.maodian').eq(jt).offset().top-140);
		})
		//图片放大
		$('img').click(function(){
			var img = $(this).attr('src');
			$('.imgtc').show().find('img').attr('src',img);
		})
		$('.imgtc').click(function(){
			$(this).toggle();
		})
	})
</script>



</body></html>