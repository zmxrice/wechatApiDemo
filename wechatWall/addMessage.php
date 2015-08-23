<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<script language="javascript">
var reBadWords = /妈的|爹的|娘的|共产|死|校长|你妈|你爹|你奶|tmd|nnd|2b|sb|草泥马|草|操|艹|cao|卧槽|傻逼|坑爹|傻|伤不起|尼玛|呆|贱|垃圾/gi;
$(document).ready(function(){
	$.ajax({
		url:"do.php",
		type:"GET",
		dataType:"json",
		success: function(res){			
			if (res.length>0){
				var str = "<li data-role='divider'>已发内容</li>";
				for(var i=0, len=res.length; i<len; i++) {
					str += "<li><h6>"+res[i].nickname+"</h6><p>"+res[i].message+"</p></li>";
				}
				$("#detail").html(str);
				$("#detail").listview("refresh");
			}
                    
		}
	});//ajax
	
	$("#sub").click(function (){
		var message=$("#message").val();
		reBadWords.lastIndex=0;
		if (message!=""){			
			if (reBadWords.test(message)===false){
				$.ajax({
				url:"add.php",
				type:"POST",
				data:"message="+message+"",
				success: function(res){			
					if (res=="success"){
						location.reload();
					}else if (res=="fail"){
						$("#warn").text("亲~不要刷屏啦，相同内容不超过两次哦~");
					}
                    
				}
				});//ajax
			}//判断是否包涵敏感词
			else{
				$("#warn").text("亲~请注意文明发言哦~");
			}
		}else{
			$("#warn").text("先输入内容再发布嘛！");
		}
	});
	
});
</script>
</head>
<body>

<div data-role="page" id="pageone">
	<div data-role="header" data-position="fixed">
		<h1>我要上墙</h1>
	</div>
	<div data-role="content">
    	<ul data-role="listview" data-inset="true" id="detail"></ul>
        <textarea name="message" id="message"></textarea>
        <a href="#" data-role="button" data-inline="true" id="sub">发布</a><p id="warn" style="color:red;"></p>
	</div>

</div> 
</body>
</html>