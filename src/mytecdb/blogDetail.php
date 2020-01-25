<html><head>
  <?php include_once("config.php") ?>
	<?php
  date_default_timezone_set("Asia/Shanghai");
  $blogTitle="";
  $blogContent="";
  $blogDate=date('Y-m-d h:i:s',time());
  $blog_type="";
  $read_count="浏览(0)";

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

    $blog_find = true;

    if (mysqli_num_rows($rs) <= 0){
    	$blog_find = false;
    }else{
    	while($row = mysqli_fetch_row($rs)){
	    $blogTitle=(string)$row[0];
	    $blogDate=(string)$row[1];
	    $blogContent = (string)$row[2];
	    $read_count = "浏览(" . (string)$row[3] . ")";
	    $blog_type = (string)$row[4];
	    break;

    	}
  	}

    mysqli_free_result($rs); //关闭数据集

    if ($blog_find){
	    //文章阅读量增加
	    $sql = "update blog set read_count=read_count+1 where id = $blogID";
	    mysqli_query($link,$sql); //获取数据集
	}else{
		$blogTitle = "未找到相关文章！";
		$blogContent = "未找到相关文章！";
	}
    
    
    //记录访问来源
    $myBlogTitle = str_replace("'", "\'", $blogTitle);
    $ip = $_SERVER["REMOTE_ADDR"];
    $sql = "insert into visit_trace(url,visitdate) values('($ip,$blogID,$myBlogTitle)',now())";
    if(isset($_SERVER['HTTP_REFERER'])){
      $url = $_SERVER['HTTP_REFERER'];
      if($url != ""){
        $sql = "insert into visit_trace(url,visitdate) values('$url($ip,$blogID,$myBlogTitle)',now())";
      }
    }
    mysqli_query($link,$sql);
    
    
    mysqli_close($link);
?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="keywords" content="database,mysql,postgresql,oracle,python,c,c++,linux,percona,数据库" />
  <meta name="description" content="本站提供数据库技术相关的文章,包括MySQL,PostgreSQL,Oracle,Linux,Python,数据库安装,升级,性能优化,源码分析,学习资料" />

<title><?php echo "$blogTitle-mytecdb-数据库之家"; ?></title>

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
				<a href="mysql.php">MySQL</a>
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
			<div class="sidebar">
				<div class="whitebg paihang">
      <h3 class="htitle">站点声明</h3>

      <p>本站为个人博客，分享数据库相关的技术文章、入门教程，如果您对MySQL、PostgreSQL、Oracle、Linux、Python等有兴趣，欢迎关注本站，共同学习进步。</p><br/>
      <p>联系方式：zxb4221@sina.com</p>
    </div>

    <div id="topReadCount" class="whitebg paihang">
    </div>
			</div>
		</div>

		<div class="main-container">

			<div class="markdown whitebg">

		  <div class="blog_title" style="margin-bottom:20px;">
		    <h2 style="color:#108AC6;">
		      <?php echo "$blogTitle"; ?>
		      <em class="actions"></em>
		    </h2>
	        <div>
	        	<ul>
	        	  <li><?php echo "$blog_type"; ?></li>&nbsp;
			      <li><?php echo "$blogDate"; ?></li>&nbsp;
			      <li><?php echo "$read_count"; ?></li>&nbsp;
			      <li style="display:none"><a id="a_blogId"><?php echo "$blogID"; ?></a></li>		      
			    </ul> 
			</div>
		  </div>
  <div class="blog_content">
    <?php echo "$blogContent"; ?>
  </div>
  

  <div class="blog_bottom">

  	

  	<div class="zan">
	  	<ul>
	  		<li>
	  			<a id="a_zan" class="diggit">赞一个(0)</a>
	  		</li>
	  		<li>
	  			<a id="a_cai" class="diggit">踩一下(0)</a>
	  		</li>
	  	</ul>
  	</div>

  	<div>
      <h3>文章评论</h3>
      <ul>
<!-- 评论 开始 -->
<div class="pinglun">
<div class="pl-520am" data-id="993" data-classid="3" data-showhot="0">

    
      <div class="pl-area-post">
        <div class="pl-post">
          <div class="pl-textarea"><textarea class="pl-post-word" id="comment" placeholder="写下你想说的，开始我们的对话"></textarea>
          </div>
          <div class="pl-tools">
             <ul>
               
               <li class="pl-tools-lastchild"><button class="pl-submit-btn" id="pl-submit-btn-main">发 布</button></li>
               <li class="username"><input type="text" id="pl-username" class="pl-key" size="15" placeholder="你的昵称" value=""></li>
             </ul>
          </div>
        </div>
      </div>

    <div class="pl-clr" id="pl-start"></div>
    <div class="pl-header">共<em id="pl-totalnum">0</em>条评论<span class="pl-userinfo"></span></div>
    <div class="pl-show-list" id="pl-show-all">
    </div>


</div>

</div>
<!-- 评论 结束 -->
</ul>
</div>

</div>  
</div>
</div>
</div>
	
</div>
<footer class="footer" style="font-size:12px;margin-top:30px;">
    	<div align="center">Copyright © 2020</div>
        <div align="center">
        	<a href="http://www.mytecdb.com" title="mytecdb-数据库之家">www.mytecdb.com</a> mytecdb All Rights Reserved.
        </div>
</footer>
<script src="http://libs.baidu.com/jquery/1.10.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var url_base = "http://mytecdb.com";

	function loadZanCai(){
		//加载赞踩
		var blogId = $("#a_blogId").text();
		var url = url_base+"/api/getZanCai.php?"+blogId
		$.get(url,function(result,status){
	  		if(status != "success"){
	  			alert("调用失败！");
	  		}else{
	  			$("#a_zan").text("赞一个("+result.zanCount+")");
	  			$("#a_cai").text("踩一下("+result.caiCount+")");
	  		}
		});
	}


	function zanCai(type){
		var blogId = $("#a_blogId").text();
	  	var url = url_base+"/api/postZanCai.php";

	  	data = {"blogId":blogId,"type":type};

	  	$.post(url,data,function(result,status){
	  	if(status != "success"){
	  		alert("调用失败！");
	  	}else{
	  		if (result.code == 0){
	  			if(type == "zan"){
	  				alert("感谢您的赞！");
	  			}else{
	  				alert("感谢您的反馈！");
	  			}
				loadZanCai();
	  		}
	  		else{
	  			alert(result.message);
	  		}
	  	}
	  });
	}

	function loadComment(){
		var blogId = $("#a_blogId").text();
	  	var url = url_base+"/api/getComment.php?"+blogId;
		$.get(url,function(result,status){
	  		if(status != "success"){
	  			alert("调用失败！");
	  		}else{

	  			$("#pl-show-all").empty();
	  			for(let i=0;i<result.length;i++){
	  				var offset = i%5;
	  				var addHtml = '<div class="pl-area pl-show-box"><div class="pl-area-userpic"><img id="pl-userpic" src="/img/user_'+offset+'.jpg"></div><div class="pl-area-post"><div class="pl-show-title"><span>'+result[i].user+'</span> <span class="pl-show-time pl-fr">'+result[i].ts+'</span></div><div class="pl-show-saytext">'+result[i].message+'</div></div><div class="pl-clr"></div></div>';
	        		$("#pl-show-all").append(addHtml);
	    		}


	    		$("#pl-totalnum").text(result.length);
	    		
	  		}
		});
	}

	function commitComment(){
		var blogId = $("#a_blogId").text();
		var url = url_base+"/api/postComment.php";
		var user = $("#pl-username").val();
		var message = $("#comment").val();

		//转义
		user = $('<div/>').text(user).html();
		message = $('<div/>').text(message).html();

		if(user == ""){
			user = "匿名用户";
		}
		if(message == ""){
			alert("评论内容不能为空！");
			return;
		}

		data = {"blogId":blogId,"user":user,"message":message};

	  	$.post(url,data,function(result,status){
	  	if(status != "success"){
	  		alert("调用失败！");
	  	}else{
	  		if (result.code == 0){
	  			
	  			alert("感谢您的评论！");
				$("#pl-username").val("");
				$("#comment").val("");
				loadComment();
	  		}
	  		else{
	  			alert(result.message);
	  		}
	  	}
	  });
	}

	function loadTopReadCount(){
		
	  	var url = url_base+"/api/getTopReadCount.php";
		$.get(url,function(result,status){
	  		if(status != "success"){
	  			alert("调用失败！");
	  		}else{

	  			$("#topReadCount").empty();
	  			var addHtml = '<h3 class="htitle">点击排行</h3><ul>';
	  			for(let i=0;i<result.length;i++){
	  				addHtml += '<li><i></i><a href="/blogDetail.php?id=' + result[i].id + '" title="' + result[i].title + '" target="_blank">' + result[i].title + '</a></li>';
	  			}
	  			addHtml += '</ul>';

	  				
	        	$("#topReadCount").append(addHtml);	
	  		}
		});
	}


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
		
		//加载排行
		loadTopReadCount();

		//加载赞踩
		loadZanCai();

		//提交赞
		var already_zan = 0;
		$("#a_zan").click(function(){

		  if (already_zan == 1){
		  	alert("您已经赞过了！");
		  	return;
		  }
		  zanCai("zan");
		  already_zan = 1;
		});

		//提交踩
		var already_cai = 0;
		$("#a_cai").click(function(){

		  if (already_cai == 1){
		  	alert("您已经踩过了！");
		  	return;
		  }
		  zanCai("cai");
		  already_cai = 1;
		});

		//加载评论
		loadComment();

		//提交评论
		$("#pl-submit-btn-main").click(function(){
		  commitComment();
		});



	})
</script>
</body></html>
