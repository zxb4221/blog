<html>
<head>

<title>Lucifer的个人博客</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

<meta charset="utf-8" />

<meta name="viewport"
	content="initial-scale=1, width=device-width, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="/css/index.css" />


<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->

<script charset="UTF-8" src="js/jquery.min.js"></script>
<script src="/js/index.js" type="text/javascript" charset="utf-8"></script>

</head>
<body class="holygrail pg-index">
<?php include_once("baidu_js_push.php") ?>
	<div class="holygrail-body">
		<div class="nav-bar">
			<div class="nav-bar-inner">
				<a href="/" class="nav-bar-logo"> <img src="img/logo.png">
				</a> <span class="nav-bar-site-title"> <a href="/">Lucifer's blog</a>
				</span>
				<button class="nav-bar-btn">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
			</div>
			<div class="nav-bar-tabs">
				<nav>
					<span class="nav-bar-tab"> <a href="/">最新文章</a>
					</span> <span class="nav-bar-tab current"> <a class="current" href="#">目录视图</a>
					</span> <span class="nav-bar-tab"> <a href="/about.html">关于博主</a>
					</span>
				</nav>
			</div>
		</div>
		<div class="main">
			<div class="tag_header">
				<span>目录视图</span>
			</div>
			<div id="article_content" class="content">
					<?php include_once("catalogViewEx.php") ?>
			</div>
			<footer class="more">
				<span class="rectangle"><a href="/?l=40" class="btn">查看更多</a></span>
			</footer>
		</div>
	</div>
	<div class="qr_code_btn_container">
		<div class="qr_code">
			<div id="qr_code_btn" class="content">
				<p class="title">关注我们</p>
				<p class="desktop_qr_tittle">扫码关注技术博客</p>
				<img src="/img/qrcode_meituantech.jpg" class="qr_img">
				<p class="tips">微信搜索 "Lucifer"</p>
			</div>
		</div>
		<a href="javascript:window.smoothScrollToTop()"><span
			class="top_btn"></span></a>
	</div>
	<footer id="footer">
		<div id="hide">
			<a href="javascript:window.smoothScrollToTop()"><img
				src="/css/s/top.png"></a>
		</div>
		<div class="ft">
			<span class="copyright">QQ:1135371534</span><span class="copyright">Email:1135371534@qq.com</span>
		</div>
	</footer>
</body>
</html>
