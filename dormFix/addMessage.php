<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<script language="javascript">
$(document).ready(function(){
	$.ajax({
		url:"do.php",
		type:"GET",
		dataType:"json",
		success: function(res){			
			if (res.length>0){
                $("#mycontent").prepend("<h4>点击评价，评价完成后才能再次报修</h4>");
				var str = "<li data-role='divider'>待评价报修</li>";
                str += "<li><a href='#evaluate' data-rel='dialog' data-transition='pop'><h2>【问题】"+res[0].title+"</h2>";
                str +="<p>【发布人】"+res[0].nickname+"<br />【电话】"+res[0].phone+"<br/>";
                str +="【宿舍】 "+res[0].dorm+"<br/ >【简介】 "+res[0].message+"<span id='infoid' style='display:none;'>"+res[0].id+"</span></p></a></li>";
                    

				$("#detail").html(str);
				$("#detail").listview("refresh");
			}
                    
		}
	});//ajax
	
	$("#sub").click(function (){
        var detail=$("#detail").text();
        var phone=$("#phone").val();
		var message=$("#message").val();
        var title = $("#title").val();
        var dorm = $("#dorm").val();
        if(detail!=""){
            $("#warn").text("请完成评价后再次报修");
        }else if (phone==""){
            $("#warn").text("请输入你的联系电话");
        }else if (title==""){
            $("#warn").text("请输入报修类型");
        }else if(message==""){
            $("#warn").text("请输入情况介绍");
        }else if(dorm==""){
            $("#warn").text("请输入宿舍号");
        }
		else{
			$.ajax({
			url:"add.php",
			type:"POST",
                data:"phone="+phone+"&message="+message+"&title="+title+"&dorm="+dorm+"",
			success: function(res){			
				if (res=="success"){
					location.reload();
				}
                    
			}
			});//ajax
		}
        
    });//sub click
    
   
    
    $("#subFeed").click(function (){
        var id = $("#infoid").text();
        var feedback = $("#feedback").val();
        if (feedback==""){
            $("#feedwarn").html("<br />请输入评价内容");
        }
		else{
			$.ajax({
			url:"addFeedBack.php",
			type:"POST",
            data:"id="+id+"&feedback="+feedback+"",
			success: function(res){			
				if (res=="success"){
					location.reload();
				}
                    
			}
			});//ajax
		}
        
    });//subFeed click
	
});
</script>
</head>
<body>

<div data-role="page" id="pageone">
	<div data-role="header" data-theme="b">
		<h1>后勤报修</h1>
	</div>
	<div data-role="content" id="mycontent">
        
    	<ul data-role="listview" data-inset="true" id="detail"></ul>
        <fieldset data-role="collapsible">
        	<legend>新增报修内容</legend>
            <label for="phone">联系电话</label>
        	<input type="text" name="phone" id="phone" />
        	<label for="title">报修类型(如:卫生间灯)</label>
        	<input type="text" name="title" id="title" />
        	<label for="dorm">宿舍号(如:梅2A****)</label>
        	<input type="text" name="dorm" id="dorm" />
        	<label for="message">情况介绍</label>
        	<textarea name="message" id="message"></textarea>
        	<a href="#" data-role="button" data-inline="true" id="sub">发布</a><p id="warn" style="color:red;">发布之后不能撤销，责任自负!</p>
        </fieldset>
	</div>

</div>
<div data-role="page" id="evaluate">
  <div data-role="content">
  <h3>维修情况评价</h3>
      <label for="feedback">请客观地填写评价内容<span id="feedwarn" style="color:red;"></span></label>
    <textarea name="feedback" id="feedback"></textarea>
    <a href="#" data-role="button" data-icon="check" data-inline="true" id="subFeed">确认</a>
    <a href="#" data-role="button" data-rel="back" data-icon="delete" data-inline="true" >取消</a>
  </div>
</div> 
</body>
</html>