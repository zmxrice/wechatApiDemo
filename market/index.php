<?php
$c = new SaeCounter();
if ($c->create('market')){
	$c->set('market',1);// 返回true
}else{
	$c->incr('market'); // 返回101
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>
<body>
<script>
$(document).ready(function(){
	$.ajax({
		url:"getAllList.php",
		type:"GET",
		dataType:"json",
		success: function(res){			
			var str = "";		
			if (res.length>0){
				str="";
				for(var i=0, len=res.length; i<len; i++) {
					
					str += "<li><a href=\"detail.php?id="+res[i].id+"\">";
					if (res[i].status=="我要买"){
						str +="<span style=\"color:blue\">【"+res[i].status+"】</span>";
					}else {
						str +="<span style=\"color:red\">【"+res[i].status+"】</span>";
					}
					str +=res[i].title+"</li>";
				}
				
            }
            $("#detail").html(str);
			$("#detail").listview("refresh");     
                    
		}
	});//ajax
});
    
</script>
<div data-role="page" id="pageone">
    <div data-role="header" data-theme="b" data-position="fixed">
		<h1>跳蚤市场</h1>
        <a href="addMessage.php" data-role="button" data-icon="plus"  rel="external">发布信息</a>
	</div>
    
  <div data-role="content">
    <ul data-role="listview" id="detail"><li>暂无记录</li></ul>
  </div>

</div> 
</body>
</html>