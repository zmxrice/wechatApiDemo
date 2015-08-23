<?php
session_start();
$user=$_SESSION["user"];
if($user==null){
    echo "<script>window.location.href='index.html';</script>";
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
var myHTML="";
$.ajax({
    dataType:"json",
	url:"doact.php",
	type:"GET",
	data:"type=init",
	success: function(json){
		if(json.length>0){
            for(var i=0;i<json.length;i++){
				myHTML+="<div data-role='collapsible'><h3>"+json[i].name+"</h3><div data-role='navbar' class='mynav'><ul>";
            	myHTML+="<li><a href='#pagethree' data-role='button' data-icon='gear' mydata='"+json[i].id+"' class='edt'>修改</a></li>";
                myHTML+="<li><a href='#' data-role='button' data-icon='delete' mydata='"+json[i].id+"' class='del'>删除</a></li></ul></div></div>";
            }
		}
        $("#myset").html(myHTML);
		$("#myset").trigger( "create" );
        
        $(".edt").click(function(){
        	$.ajax({
            dataType:"json",
			url:"doact.php",
			type:"POST",
			data:"actype=edt&edtid="+$(this).attr("mydata")+"",
			success: function(json){
                $("#myid").text(json[0].id);
                $("#edt_fullname").val(json[0].name);
                $("#edt_location").val(json[0].location);
                $("#edt_dep").val(json[0].dep);
                $("#edt_detail").val(json[0].detail);
                $("#edt_day").val(json[0].day);
			}
            });
		});

		$(".del").click(function(){
    		$.ajax({
			url:"doact.php",
			type:"POST",
			data:"actype=del&delid="+$(this).attr("mydata")+"",
			success: function(json){
				location.reload();
			}
            });
        
		});
	}
});



    
$("#add").click(function(){
	if($("#fullname").val()==""){
		$("#addwarn").text("请输入活动名称");
	}
	else if($("#day").val()==""){
		$("#addwarn").text("请选择活动日期");
	}
	else if($("#location").val()==""){
		$("#addwarn").text("请输入活动地点");
	}
	else if($("#dep").val()==""){
		$("#addwarn").text("请输入活动主办单位");
	}
	else if($("#detail").val()==""){
		$("#addwarn").text("请输入活动简介");
	}else{
		$.ajax({
		url:"doact.php",
		type:"POST",
		data:"dotype=add&fullname="+$("#fullname").val()+"&day="+$("#day").val()+"&location="+$("#location").val()+"&dep="+$("#dep").val()+"&detail="+$("#detail").val()+"",
		success: function(data){
			$("#addwarn").text("操作成功");
             $(".re").trigger("click");
        	location.reload();
		}
		});
	}
});


$("#edt").click(function(){
	if($("#edt_fullname").val()==""){
		$("#edtwarn").text("请输入活动名称");
	}
	else if($("#edt_day").val()==""){
		$("#edtwarn").text("请选择活动日期");
	}
	else if($("#edt_location").val()==""){
		$("#edtwarn").text("请输入活动地点");
	}
	else if($("#edt_dep").val()==""){
		$("#edtwarn").text("请输入活动主办单位");
	}
	else if($("#edt_detail").val()==""){
		$("#edtwarn").text("请输入活动简介");
	}else{
		$.ajax({
		url:"doact.php",
		type:"POST",
		data:"dotype=edt&edtid="+$("#myid").text()+"&edt_fullname="+$("#edt_fullname").val()+"&edt_day="+$("#edt_day").val()+"&edt_location="+$("#edt_location").val()+"&edt_dep="+$("#edt_dep").val()+"&edt_detail="+$("#edt_detail").val()+"",
		success: function(data){
			$("#edtwarn").text("操作成功");
             $(".re").trigger("click");
        	location.reload();
		}
		});
	}
});

$("#passchange").click(function(){
	if($("#old_pass").val()==""){
		$("#passwarn").text("请输入原始口令");
	}else if($("#new_pass").val()==""){
		$("#passwarn").text("请输入新口令");
	}else if($("#new_confirm").val()!=$("#new_pass").val()){
		$("#passwarn").text("两次口令输入不统一");
	}else{
		$.ajax({
		url:"passchange.php",
		type:"POST",
		data:"old_pass="+$("#old_pass").val()+"&new_pass="+$("#new_pass").val()+"",
		success: function(data){
			if (data=="success"){
				$("#passwarn").text("操作成功,请重新登录");
             	$(".re").trigger("click");
        		location.reload();
			}else if(data=="fail"){
				$("#passwarn").text("原口令输入错误");
			}
		}
		});
	}
});

$("#logout").click(function(){
	$.ajax({
		url:"logout.php",
		type:"POST",
		success: function(){
        	location.reload()
		}
		});
});

});
</script>

<div data-role="page" id="pageone">
  <div data-role="header">
    <h1>活动列表</h1>
  </div>

  <div data-role="content">
      <h4>注：过期活动不在微信平台上展示，活动具体时间可在简介中注明</h4>
	<a href="#pagetwo" data-role="button" >添加</a>
    <div data-role="collapsible-set" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" id="myset">
 
    </div>
    <a href="#pagefour" data-role="button" data-inline="true">修改口令</a>
    <a href="#" data-role="button" data-inline="true" id="logout">安全登出</a>
  </div>

</div> 

<div data-role="page" id="pagetwo">
  <div data-role="header">
  <h1>活动录入</h1>
  </div>

  <div data-role="content">
  	<h4>如果你是IE用户，日期无法选择时，请按照2014-04-08填写日期~</h4>
	<a href="#pageone" data-role="button" data-icon="back" data-inline="true" class="re">返回</a>
      <div data-role="fieldcontain">
        <label for="fullname">活动名称：</label>
        <input type="text" name="fullname" id="fullname">    
        <label for="day">日期：</label>
        <input type="date" name="day" id="day">
        <label for="location">地点：</label>
        <input type="text" name="location" id="location">
        <label for="dep">主办单位：</label>
        <input type="text" name="dep" id="dep">
        <label for="detail">简介：</label>
        <textarea name="detail" id="detail"></textarea>
      </div>
      <a href="#" data-role="button" data-inline="true" id="add">确认</a><p id="addwarn" style="color:red;"></p>
  </div>
</div>

<div data-role="page" id="pagethree">
  <div data-role="header">
  <h1>活动修正</h1>
  </div>
    <span id="myid" style="display:none"></span>
  <div data-role="content">
  <h4>如果你是IE用户，日期无法选择时，请按照2014-04-08填写日期~</h4>
  	<a href="#pageone" data-role="button" data-icon="back" data-inline="true" class="re">返回</a>
      <div data-role="fieldcontain">
        <label for="edt_fullname">活动名称：</label>
        <input type="text" name="edt_fullname" id="edt_fullname">    
        <label for="edt_day">日期：</label>
        <input type="date" name="edt_day" id="edt_day">
        <label for="edt_location">地点：</label>
        <input type="text" name="edt_location" id="edt_location">
        <label for="edt_dep">主办单位：</label>
        <input type="text" name="edt_dep" id="edt_dep">
        <label for="edt_detail">简介：</label>
        <textarea name="edt_detail" id="edt_detail"></textarea>
      </div>
      <a href="#" data-role="button" data-inline="true" id="edt">确认</a><p id="edtwarn" style="color:red;"></p>
  </div>
</div>


<div data-role="page" id="pagefour">
  <div data-role="header">
  <h1>口令修改</h1>
  </div>
    <span id="myid" style="display:none"></span>
  <div data-role="content">
  	<a href="#pageone" data-role="button" data-icon="back" data-inline="true" class="re">返回</a>
      <div data-role="fieldcontain">
        <label for="old_pass">原口令：</label>
        <input type="password" name="lod_pass" id="old_pass">    
        <label for="new_pass">新口令：</label>
        <input type="password" name="new_pass" id="new_pass">
        <label for="new_confirm">再次输入新口令：</label>
        <input type="password" name="new_confirm" id="new_confirm">
      </div>
      <a href="#" data-role="button" data-inline="true" id="passchange">确认</a><p id="passwarn" style="color:red;"></p>
  </div>
</div>

</body>
</html>
