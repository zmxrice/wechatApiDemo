<?php
$c = new SaeCounter();
if ($c->create('activity')){
	$c->set('activity',1);// 返回true
}else{
	$c->incr('activity'); // 返回101
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
var myHTML="<h2>还没有活动哦~</h2>";
$.ajax({
    dataType:"json",
	url:"init.php",
	type:"GET",
	success: function(json){
		if(json.length>0){		
			myHTML="";
            for(var i=0;i<json.length;i++){
                myHTML+="<div data-role='collapsible'><h3>"+json[i].name+"</h3><span><strong>[主题]:</strong> "+json[i].name+"</span><br/ >";
                myHTML+="<span><strong>[时间]:</strong> "+json[i].day+"</span><br/>";
                myHTML+="<span><strong>[地点]:</strong> "+json[i].location+"</span><br/>";
                myHTML+="<span><strong>[主办]:</strong> "+json[i].dep+"</span><br/>";
                myHTML+="<span><strong>[简介]:</strong> "+json[i].detail+"</span></div>";
            }
		}
        $("#myset").html(myHTML);
		$("#myset").trigger( "create" );
	}
});



});
</script>
<div data-role="page" id="pageone">
    <div data-role="header" data-theme="b" data-position="fixed">
		<h1>精彩活动</h1>
	</div>
    
  <div data-role="content">
      点击列表查看详情
    <div data-role="collapsible-set" id="myset" data-inset="false">
 
    </div>
  </div>

</div> 
</body>
</html>