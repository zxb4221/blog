<html><head>
  <?php include_once("config.php") ?>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getData.php") ?>
	

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="keywords" content="database,mysql,linux,percona,数据库" />
  <meta name="description" content="database,mysql,linux,percona" />

<title><?php echo get_title(); ?></title>

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

<?php
    $countOffset=$currentPage*$countPerPage;
    
    $server_name=get_server_name();//($config, "server_name", "string");  //数据库服务器名称 
    $username=get_user_name();//($config, "username", "string") ; // 连接数据库用户名 
    $password=get_password();//($config, "password", "string") ; // 连接数据库密码 
    $mysql_database=get_database();//($config, "mysql_database", "string");; // 数据库的名字
    
    $error_level = error_reporting(0);
    $link=mysqli_connect($server_name,$username,$password,$mysql_database);
    error_reporting($error_level);

    if(!$link) {die("没有连接成功!");}
  
    mysqli_query($link,"SET NAMES utf8");

	
	if ($type != -1){
		$q = "select blog.id,blog.title,blog.modifydate,blog.read_count,blog.content,blog_type.id,blog_type.name from blog,blog_type where blog.type_id=blog_type.id and blog.type_id=$type order by blog.modifydate desc limit $countOffset,$countPerPage";
	}else{
    	$q = "select blog.id,blog.title,blog.modifydate,blog.read_count,blog.content,blog_type.id,blog_type.name from blog,blog_type where blog.type_id=blog_type.id order by blog.modifydate desc limit $countOffset,$countPerPage";
	}
	
	
	
    $rs = mysqli_query($link,$q); //获取数据集
    if (mysqli_num_rows($rs) <= 0){
    	echo "<p>没有相关数据！</p>";
    }
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