<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信墙抽奖</title>
</head>
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery.corner.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".show").corner("20px");
	$(".btn a").corner("10px");
	$.ajax({
		url:"initprize.php",
		type:"GET",
        dataType:"json",
		success: function(res){
			if (res.length>0){
				var num = res.length-1;
                var show = $("#show");
				var btn = $("#btn");
                var temp = $("#temp");
                var ol = $("#con ol");
				var open = false;
				var result = new Array();
                
                show.text("共有"+res.length+"人参加");
	
				function change(){
					var randomVal = Math.round(Math.random() * num);
					var prizeName = res[randomVal].nickname;
                    temp.text(randomVal);
					show.text(prizeName);
				}
                
                btn.click(function(){
                    if(!open){
						timer=setInterval(change,30);
						btn.removeClass('start').addClass('stop').text('停止');
						open = true;
                        
					}else{
						clearInterval(timer);
						btn.removeClass('stop').addClass('start').text('开始抽奖');                       
						open = false;
						if ($.inArray(show.text(), result)<0){						
							result.push(show.text());
						
                         $.ajax({
							url:"postWin.php",
							type:"POST",
                            data:"win="+show.text()+""
                         });//postWin
                        ol.append("<li><a href='#' class='face'><img src='"+res[temp.text()].headimgurl+"' width='60px' height='60px' /></a><br /><span>"+res[temp.text()].nickname+"</span></li>");
						$(".face img").corner("5px");
						}// 判断是否已经抽到
						
                    }
                });
			}
                    
		}
	});//ajax
    
});
</script>
<style>
body{ background:#fff;}
img { border:0;}
.wrap{ width:300px; margin:50px auto; font-family:"微软雅黑"; float:right;}
.show{ width:300px; height:300px; background-color:#00C5CD; line-height:300px; text-align:center; color:#fff; font-size:32px; background-image: -webkit-gradient(linear,0% 0%, 0% 100%, from(#00BFFF), to(#009ACD), color-stop(0.5,#00B2EE)); -moz-box-shadow:2px 2px 10px #BBBBBB; -webkit-box-shadow:2px 2px 10px #BBBBBB; box-shadow:2px 2px 10px #BBBBBB;}
.btn a{ display:block; width:120px; height:50px; margin:30px auto; text-align:center; line-height:50px; text-decoration:none; color:#fff; -moz-box-shadow:2px 2px 10px #BBBBBB; -webkit-box-shadow:2px 2px 10px #BBBBBB; box-shadow:2px 2px 10px #BBBBBB;}
.btn a.start{ background:#80b600;}
.btn a.start:hover{ background:#75a700;}
.btn a.stop{ background:#CD5C5C;}
.btn a.stop:hover{ background:#CD0000;}
    
ol,li{ list-style-type:none;}
#con {width:150px; margin:30px auto; font-family:"微软雅黑"; float:right;}
#con ol{ margin:0; top:0; left:0; padding:0;}
#con ol li { margin:10px;}
#con ol li a.face{ width:60px; height:60px;}
#con ol li span{font-size:1.2em; color:#007bc4;}
</style>

<body>
<div style="position:relative; width:960px; margin:0;margin:10px auto 50px auto;">

<div style="float:right; margin:50px auto;"><img src="4.png" width="392"/><br/>
<img src="5.png" width="392"/></div>
<div class="wrap">
	<div class="show" id="show">微信上墙活动抽奖</div>
	<div class="btn">
		<a href="#" class="start" id="btn">开始抽奖</a>
	</div>
</div>
<div id="con">
    <span id="temp" style="display:none;"></span>
    <ol>
        
    </ol>
</div>

</div>
</body>
</html>