<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<head>
  <?php include_once("config.php") ?>
  <?php include_once("php/common.php") ?>
  <?php include_once("php/getData.php") ?>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  

  <meta name="keywords" content="database,mysql,linux,percona,数据库" />
  <meta name="description" content="database,mysql,linux,percona" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link href="css/index.css" media="screen" rel="stylesheet" type="text/css">


  <title><?php echo get_title(); ?></title>
<style>
.ul_other
{
list-style-type:none;
margin:0;
padding:0;
margin-left:0;
}
.a_other:link,.a_other:visited
{
display:block;
font-weight:bold;
color:#FFFFFF;
background-color:#108ac6;
width:120px;
text-align:center;
padding:4px;
text-decoration:none;
text-transform:uppercase;
}
.a_other:hover,.a_other:active
{
background-color:#cc0000;
}
.li_other
{
padding:0px;
}
</style>



</head>
<body>
  <div id="page">
    <div id="branding" class="clearfix" style="overflow: hidden;background: none;padding:0 0 2px;">
   </div>
   <div id="branding" class="clearfix">
    <div id="blog_name">
      <h1><a href="/">welcome to my technology database</a></h1>
      
    </div>
    <div id="fd"></div>
    <div id="blog_navbar">
      <ul id="blog_navbar_ul">
        
        <?php
        	if ($type == -1){
        		echo "<li class=\"blog_navbar_for\"><a href=\"#\"><strong>最新文章</strong></a></li>";
        	}else{
        		echo "<li><a href=\"index.php\"><strong>最新文章</strong></a></li>";
        	}
        	
	        for($i=0;$i<count($g_BlogTypesName);$i++){
	        	if ($i < 5){
	        		if ($g_BlogTypesId[$i] == $type){
	        			echo "<li class=\"blog_navbar_for\"><a href=\"index.php?type=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]</a></li>";
	        		}
	        		else{
	    				echo "<li><a href=\"index.php?type=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]</a></li>";
	    			}
	    		}
	        }
	        
	        if(count($g_BlogTypesName) > 5){
	    		echo "<li><a id=\"a_hide\" class=\"nav-other\" href=\"javascript:void(0)\">其他</a><div id=\"div_hide\" class=\"more-nav-box\" ><ul class=\"ul_other\">";
	    		for($i=5;$i<count($g_BlogTypesName);$i++){
	    			echo "<li style=\"padding:0px;\" class=\"li_other\"><a class=\"a_other\" href=\"index.php?type=$g_BlogTypesId[$i]\">$g_BlogTypesName[$i]</a></li>";
	    		}
	    		echo "</ul></div></li>";
	        }
	        
        ?>
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

<div id="footer" class="clearfix">
  <div id="copyright">
    <hr>
    声明：本站发布的信息，版权属于作者，受法律保护，若有侵权，请联系站长删除。<br>
    © 2019-2020 www.mytecdb.com.   All rights reserved.
  </div>
</div>
</div>

</body>
<script>
  (function(){
  	  var a_hide = document.getElementById('a_hide');
      var box = document.getElementById('div_hide');
 	  var timer = null;
      a_hide.onmouseup = a_hide.onmouseover = box.onmouseover = function(){
      	  if(timer) clearTimeout(timer);
          box.style.display = 'block';
      }
      a_hide.onmouseout = box.onmouseout = function(){
      	  timer = setTimeout(function(){
            box.style.display = 'none';
          },500);
      }
  })();
</script>
</html>
