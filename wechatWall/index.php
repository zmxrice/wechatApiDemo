<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信墙</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<style type="text/css">
ul,li{ list-style-type:none;}
#con{ width:900px; height:520px; margin:20px auto 10px auto; position:relative; border:1px #d3d3d3 solid; background-color:#fff; overflow:hidden;}
#con ul{ position:absolute; margin:10px; top:0; left:0; padding:0;}
#con ul li{ width:880px;  border-bottom:1px #ccc dotted; padding:20px 0; overflow:hidden; height:90px;}
#con ul li a.face{ float:left; width:80px; height:80px;}
#con ul li h4{margin-left:88px; font-size:1.5em}
#con ul li p{ margin-left:88px; font-size:2.2em}
</style>
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery.corner.js"></script>
<script language="javascript">
$(document).ready(function(){	
	myAjax();
	var scrtime;
    $("#con").hover(function(){
         clearInterval(scrtime);
    },function(){
        scrtime = setInterval("myAjax()",2000);//setInterval
     }).trigger("mouseleave");
	
});

function myAjax(){
	var num=$("#num").text();
	$.ajax({
		url:"init.php",
		type:"GET",
		data:"num="+num+"",
		dataType:"json",
		success: function(res){
			var len=res.length;			
			if (len>0){
				var str="";
				$("#num").text(res[0].id);
				str+="<li><a href='#' class='face'><img src='"+res[0].headimgurl+"' width='80px' height='80px' /></a>";
				str+="<h4><a href='#'>"+res[0].nickname+"</a></h4><p>"+res[0].message+"</p></li>";
						
				var ul = $("#con ul");
				ul.append(str).trigger("create");
				$(".face img").corner("5px");
						
                var liHeight = ul.find("li:last").height();
                ul.animate({marginTop : liHeight+30 +"px"},1000,function(){
                	ul.find("li:last").prependTo(ul)
                	ul.find("li:first").hide();
                	ul.css({marginTop:0});
                	ul.find("li:first").fadeIn(1000);
                });//animate        
       
			}//if len
                    
		}//success function
	});//ajax           	
}

function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}
</script>
</head>

<body>
<div id="main">
   <h2 class="top_title">中国矿业大学微信墙</h2><span id="num" style=" display:none">0</span>
   <div class="demo">  
   		<div id="con">
  			<ul>
    			
  			</ul>
		</div>
   </div>
   <div align="center">
        <a onclick="toggleFullScreen()" href="#" style="margin-right:30px;">全屏/退出</a><a href="choujiang.php" target="_blank">抽奖</a><br/>
   </div>
</div>

</body>
</html>
