
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>编辑文章</title>
	<link rel="stylesheet" href="../js/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="../js/kindeditor/plugins/code/prettify.css" />
	<script charset="UTF-8" src="../js/jquery.min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/kindeditor-all-min.js"></script>
	<script charset="utf-8" src="../js/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="../js/kindeditor/plugins/code/prettify.js"></script>
	
	<?php
	function getconfig($file, $ini, $type="string") 
	{ 
		if ($type=="int") 
		{ 
			$str = file_get_contents($file); 
			$config = preg_match("/" . $ini . "=(.*);/", $str, $res); 
			Return $res[1]; 
		} 
		else 
		{ 
			$str = file_get_contents($file); 
			$config = preg_match("/" . $ini . "=\"(.*)\";/", $str, $res); 
			if($res[1]==null) 
			{ 
				$config = preg_match("/" . $ini . "='(.*)';/", $str, $res); 
			} 
			Return $res[1]; 
		} 
	} 

	function updateconfig($file, $ini, $value,$type="string") 
	{ 
		$str = file_get_contents($file); 
		$str2=""; 
		if($type=="int") 
		{ 
			$str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=" . $value . ";", $str); 
		} 
		else 
		{ 
			$str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=\"" . $value . "\";",$str); 
		} 
		file_put_contents($file, $str2); 
	} 


	$param = $_SERVER["QUERY_STRING"];
	$arrParam = explode("=", $param);
	$blogID = $arrParam[1];
	
	echo $blogID;		
	echo "<div id=\"tmp_id\" style=\"display:none;\">$blogID</div>";


	$config = "../config.php";
	$server_name=getconfig($config, "server_name", "string");  //数据库服务器名称 
	$username=getconfig($config, "username", "string") ; // 连接数据库用户名 
	$password=getconfig($config, "password", "string") ; // 连接数据库密码 
	$mysql_database=getconfig($config, "mysql_database", "string");; // 数据库的名字

	$link=mysqli_connect($server_name,$username,$password,$mysql_database);
	if(!$link) echo "没有连接成功!";
	$link->set_charset("utf8");


	$type_id=-1;

	if($blogID!="-1")
	{
		



	    $q = "SELECT title,modifydate,content,type_id FROM blog where id=$blogID"; //SQL查询语句



	    $rs = $link->query($q);
	    if(!$rs){die("Valid result!");}


	    $title="";
	    $content="";
	    
	    while($row = $rs->fetch_assoc()){

	    	$title=$row["title"];
	    	$content=$row["content"];
	    	$type_id=$row["type_id"];

	    	echo "<div id=\"tmp_title\" style=\"display:none;\">$title</div>";
	    	echo "<div id=\"tmp_content\" style=\"display:none;\">$content</div>";
	    	echo "<div id=\"tmp_type_id\" style=\"display:none;\">$type_id</div>";
	    	break;
	    }



	    $htmlData = '';
	    if (!empty($_POST['content'])) {
	    	if (get_magic_quotes_gpc()) {
	    		$htmlData = stripslashes($_POST['content']);
	    	} else {
	    		$htmlData = $_POST['content'];
	    	}
	    }
	}
	echo "<select id=\"tmp_blogType\" style=\"display:none;\">";

	$q = "select id,name from blog_type";
	$rs = $link->query($q);
	if(!$rs){die("Valid result!");}
	while($row = $rs->fetch_assoc()){
		$id=$row["id"];
		$name=$row["name"];
		if($type_id == $id)
			echo "<option selected value =\"$id\">$name</option>";
		else
			echo "<option value =\"$id\">$name</option>";
	}
	echo "</select>";
	$link->close();




	?>
	<script>

		KindEditor.ready(function(K) {
			//alert(g_param);
			$('#text_title').val($('#tmp_title').html());
			$('#text_content').val($('#tmp_content').html());
			$('#text_blogID').val($('#tmp_id').html());
			$('#sel_blog_type').html($('#tmp_blogType').html());
			$('#text_blog_type_id').val($('#tmp_type_id').html());

			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '../js/kindeditor/plugins/code/prettify.css',
				uploadJson : './upload_json.php',
				fileManagerJson : './file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>


</head>
<body>
	
	<form name="example" method="post" action="save_blog.php">
		<input id="text_blogID" name="blogID" type="text" style="display:none;" value="-1"></input>
		<input id="text_title" type="text" name="title" style="width:700px;height:25px;"/>
		<textarea id="text_content" name="content" style="width:700px;height:500px;visibility:hidden;"></textarea>
		<br/>
		<input id="text_blog_type_id" name="blog_type"  readonly="readonly">
		<select id="sel_blog_type" onchange= "$('#text_blog_type_id').val(this.value);">	  
		</select>
	</input>
	<br/>
	<input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
</form>
</body>
</html>

