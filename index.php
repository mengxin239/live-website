<?php
include "config.php";
?>
<html>
	<head>
		<link href="https://cdn.bootcss.com/video.js/7.6.5/alt/video-js-cdn.min.css" rel="stylesheet">
		    <script src="https://cdn.bootcss.com/video.js/6.6.2/video.js"></script>
		<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
		</script>
		<script src="https://cdn.bootcss.com/videojs-contrib-hls/5.15.0/videojs-contrib-hls.min.js"></script>
		<script>
			var user,text;
		function GetText(){
			var usernametext = document.getElementById("username");
			username = usernametext.value;
			var inputtext = document.getElementById("text");
			text = inputtext.value;
		}
	$(document).ready(function(){
		$("button").click(function(){
			GetText();
			var status = "true";
			if(username == '' || text == ''){
				status = "false";
			}
			$.get("get.php?request=send&sure="+status+"&user="+username+"&data="+text,function(data,status){
				show();
				if(status=="true"){
					alert("发送成功！");
				}
			});
	});
});
function show(text)
{
	if(<?php file_get_contents($method.'://'.$websiteurl.'/get.php?request=islive')?>){
		if (video.paused()){
			video.play()
		}
	}
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
		<title><?php echo $name ?> - <?php echo $description ?></title>
	</head>
<body class='mdui-theme-primary-indigo mdui-theme-accent-pink'>
<div class="mdui-appbar">
<div class="mdui-toolbar mdui-color-indigo">
<a href="./" class="mdui-typo-headline"><?php echo $name ?></a>
<div class="mdui-toolbar-spacer"></div>
<a href="javascript:window.location.reload()" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">refresh</i></a>
</div>
</div>
<div id="container" class="mdui-container mdui-p-t-3">
<div class="mdui-col">
<div class="mdui-card">
<div class="mdui-card-primary">
<div class="mdui-card-primary-title mdui-text-truncate"><?php echo $name ?></div>
<div class="mdui-card-primary-subtitle"><video id="video" class="video-js vjs-default-skin" controls autoplay="autoplay" width="640" height="320" data-setup='{}'>
				 <source src="<?php if(file_get_contents($method.'://'.$websiteurl.'/get.php?request=islive')){echo $address;}else{echo $method.'://'.$websiteurl.'/notlive.m3u8';} ?>" type="application/x-mpegURL" />
		</video></div>
</div>
</div>
</div>
</div>
<div id="container" class="mdui-container mdui-p-t-3">
<div class="mdui-col">
<div class="mdui-card">
<div class="mdui-card-primary">
<div class="mdui-card-primary-title mdui-text-truncate">评论</div>
<div class="mdui-container">
	    <div class="mdui-textfield">
	      <label class="mdui-textfield-label " id="textwindow">还没有评论哦</label>
	    </div>
		<div class="mdui-container">
		    <div class="mdui-textfield">
		      <input class="mdui-textfield-input" id="username" type="text" placeholder="昵称"/>
		    </div>
		  </div>
		  <div class="mdui-container">
		    <div class="mdui-textfield">
		      <input class="mdui-textfield-input" id="text" type="text" placeholder="信息"/>
		    </div>
		  </div>
		  <div class="mdui-container">
		<button id="send" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">发送</button>
		</div>
</div>
</div>
</div>
</div>
</div>
<script src='https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js'></script>
<script>
	 var video = videojs('video',{
	        bigPlayButton : true, 
	        textTrackDisplay : false, 
	        posterImage: false,
	        errorDisplay : true,
	        controlBar: {volumePanel:{inline:false}},
	        playbackRates: [0.5,1,1.25,1.5,2],
	    },function(){
	        this.on('error',function(){
	            video.errorDisplay.close();
					$.get('/get.php?request=islive',function(data){  
					if(!data){
						alert("现在没在直播，直播时间为<?php echo $starttime ?>——<?php echo $endtime ?>")
					}
				       }); 
	        }) 
	    }
	    )
	    video.play() // 视频播放
	    video.pause() // 视频暂停
	    var vol = 0.1;  //1代表100%音量，每次增减0.1
	    var time = 10; //单位秒，每次增减10秒
	    document.onkeyup = function (event) {//键盘事件
	        var e = event || window.event || arguments.callee.caller.arguments[0];
			if (e && e.keyCode === 38) {
	            // 按 向上键
	            c_volume = video.volume()
	            if(c_volume+vol > 1){
	                video.volume(1)
	            }else{
	                video.volume(c_volume+vol)
	            }
	            return false;
	        }else if (e && e.keyCode === 40) {
	            // 按 向下键
	            c_volume = video.volume()
	            if(c_volume-vol < 0){
	                video.volume(0)
	            }else{
	                video.volume(c_volume-vol)
	            }
	            return false;
	        }else if (e && e.keyCode === 32) {
	            // 按 空格键
	            if (video.paused()){
	                video.play()
	            }else{
	                video.pause()
	            }
	            return false;
	        }
	
	    }
</script>
</body>
</html>
