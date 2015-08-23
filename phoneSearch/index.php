<?php
$c = new SaeCounter();
if ($c->create('phone')){
	$c->set('phone',1);// 返回true
}else{
	$c->incr('phone'); // 返回101
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
<script>
$(document).ready(function(){
	var sugList = $("#suggestions");	
	$("#searchField").on("input click", function() {
		var text = $(this).val();
		if(text.length =="") {
			sugList.html("");
			sugList.listview("refresh");
		} else if(text!=""){
			$.ajax({
			url:"search.php",
			type:"GET",
			dataType:"json",
			data:"search="+text+"",
			success: function(res){
				var str = "";
				for(var i=0, len=res.length; i<len; i++) {
                    str += "<li><a href='#second' mydata='"+res[i].dep+"' class='nextSearch'>"+res[i].dep+"</a></li>";
				}
				sugList.html(str);
				sugList.trigger( "create" );
				sugList.listview("refresh");
                
                
                $(".nextSearch").click(function(){
					var dep=$(this).attr("mydata")
        			$("#mytitle").text(dep);
        			$.ajax({
						url:"neSearch.php",
						type:"GET",
						dataType:"json",
						data:"dep="+dep+"",
						success: function(res){
							var str1 = "";
							for(var i=0, len=res.length; i<len; i++) {
                                str1 += "<li><a href='tel:"+res[i].ph_num+"'>"+res[i].office+"</a></li>";
							}
							$("#detail").html(str1);
                            $("#detail").trigger( "create" );
							$("#detail").listview("refresh");
                    
						}
       		 		});
   			 
   			 	});
                              
                
			}
        	});          
			
		}
	});
    
    

});

</script>

<body>

<div data-role="page" id="mainPage">

	<div data-role="header" data-theme="b" data-position="fixed">
		<h1>校内办公电话查询</h1>
	</div>

	<div data-role="content">
        <h3>请输入您要查询的部门或单位名字（简称或全称均可）</h3>
		<input type="search" id="searchField" placeholder="搜索...">
		<ul id="suggestions" data-role="listview" data-inset="true"></ul>
	</div>

</div>

<div data-role="page" id="second">

	<div data-role="header" data-theme="b" data-position="fixed">
    <a href="#mainPage" data-role="button" data-icon="back" data-inline="true" data-theme="b">返回</a>
		<h1 id="mytitle"></h1>
	</div>

	<div data-role="content">
        
        <div data-role="fieldcontain">
		<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="过滤 ..." id="detail">
        </ul>
        </div>
	</div>

</div>

</body>
</html>
