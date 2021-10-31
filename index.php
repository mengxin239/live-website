<?php
$name = "bilibili";
$description="something";
?>
<html>
	<head>
		<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
		</script>
		<script>
var savedtext;
var user;
$(document).ready(function(){
	$("button").click(function(){
		$.get("get.php?request=send&user="+user+"&data="+savedtext,function(data,status){
			show();
			alert("结果: " + data + "\n状态: " + status);
			});
	});
});
function save(text){
	savedtext=text;
	
}
function saveusername(username){
	user=username;
}
function show(text)
{
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {    
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("textwindow").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","get.php?request=getupdate",true);
    xmlhttp.send();
	}
		show();
		setInterval("show()",1000); 
		</script>
		<!-- MDUI CSS -->
		<link
		  rel="stylesheet"
		  href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
		  integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
		  crossorigin="anonymous"
		/>
		<title><?php echo $name ?>直播 - <?php echo $description ?></title>
	</head>
	<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
		<div class="mdui-container">
		  <div class="mdui-toolbar mdui-color-theme">
		    <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
		    <span class="mdui-typo-title"><?php echo $name ?>直播</span>
		    <div class="mdui-toolbar-spacer"></div>
		    <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></a>
		    <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">refresh</i></a>
		    <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">more_vert</i></a>
		  </div>
		</div>
		<center>
		<video id="video" class="video-js vjs-default-skin" controls autoplay="autoplay" width="640" height="320" data-setup='{}'>
				 <source src="http://81.70.247.54/live/livestream.m3u8" type="application/x-mpegURL" />
		</video>
		<form> 
		昵 称<input type="text" onkeyup="saveusername(this.value)"><br>
		评 论:<input type="text" onkeyup="save(this.value)">
		</form>
		<button>发送评论</button>
		<p id="textwindow">还没有评论呢</p>
		<!-- MDUI JavaScript -->
		<script
		  src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
		  integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
		  crossorigin="anonymous"
		></script>
	</body>
</html>