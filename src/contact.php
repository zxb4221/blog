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
					<span>读者留言</span> 
					<div id="fd"></div>  
				</div>     


				<div class="about_main">
					<div id="contact-form-302">
						<form action="#" method="post" class="contact-form commentsblock">
							<div>
								<label for="g302-name" class="grunion-field-label name">Name<span>(required)</span></label>
								<input type="text" name="g302-name" id="g302-name" value="" class="name" required="" aria-required="true">
							</div>

							<div>
								<label for="g302-email" class="grunion-field-label email">Email<span>(required)</span></label>
								<input type="email" name="g302-email" id="g302-email" value="" class="email" required="" aria-required="true">
							</div>

							<div>
								<label for="g302-website" class="grunion-field-label url">Website</label>
								<input type="text" name="g302-website" id="g302-website" value="" class="url">
							</div>

							<div>
								<label for="contact-form-comment-g302-comment" class="grunion-field-label textarea">Comment<span>(required)</span></label>
								<textarea name="g302-comment" id="contact-form-comment-g302-comment" rows="20" class="textarea" required="" aria-required="true"></textarea>
							</div>
							<p class="contact-submit">
								<input type="submit" value="Submit »" class="pushbutton-wide">
								<input type="hidden" name="contact-form-id" value="302">
								<input type="hidden" name="action" value="grunion-contact-form">
							</p>
						</form>
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