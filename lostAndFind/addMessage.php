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
		url:"getSingleList.php",
		type:"GET",
		dataType:"json",
		success: function(res){
			var str = "";		
			if (res.length>0){
				str = "<li data-role='divider'>已发内容</li>";
				for(var i=0, len=res.length; i<len; i++) {
					str += "<li><a href=\"showDetail.php?id="+res[i].id+"\">【"+res[i].status+"】"+res[i].title+"</li>";
				}
				
            }
			$("#detail").html(str);
			$("#detail").listview("refresh");
                    
		}
	});//ajax
    
   
	
});

 function check(){
        var title=$("#title").val();
        var contact=$("#contact").val();
        var info=$("#info").val();
        if (title==""){
            $("#warn").text("请输入物品名称");
            return false;
        }else if(contact==""){
            $("#warn").text("请输入联系方式");
            return false;
        }else if(info ==""){
            $("#warn").text("请输入简介");
            return false;
        }else{
            return true;
        }
    }
    
</script>
</head>
<body>
<div data-role="page" id="list">
	<div data-role="header" data-theme="b" data-position="fixed">
        <a href="index.php" data-role="button" data-icon="home"  rel="external">主页</a>
        
		<h1>招领信息管理</h1>
        <a href="#add" data-role="button" data-icon="plus">新增</a>
	</div>
	<div data-role="content">
    	<ul data-role="listview" data-inset="true" id="detail"><li>暂无记录</li></ul>
        
	</div>

</div>
    
<div data-role="page" id="add">
	<div data-role="header" data-theme="b" data-position="fixed">
		<h1>发布招领信息</h1>
        <a href="#list" data-role="button" data-icon="back">返回列表</a>
	</div>
	<div data-role="content">
        <form action="upload_file.php" method="post" enctype="multipart/form-data"  data-ajax="false">
        <fieldset data-role="controlgroup" data-type="horizontal">
        	<label for="sell">丢失</label>
          	<input type="radio" name="switch" id="sell" value="丢失" checked />
          	<label for="buy">捡到</label>
          	<input type="radio" name="switch" id="buy" value="捡到" />
        </fieldset> 
            <label for="title">物品名称</label>
            <input type="text" name="title" id="title" />
            <label for="contact">联系方式</label>
            <input type="text" name="contact" id="contact" />
        	<label for="file">图片</label>
        	<input type="file" name="file" id="file" />
            <label for="info">物品简介</label>
            <textarea name="info" id="info"></textarea>
        	<input type="submit" onclick="return check();" name="submit" value="提交" />
        </form>
        <p id="warn" style="color:red;"></p>
	</div>

</div>

</body>
</html>