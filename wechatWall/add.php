<?php
session_start();
$openid=$_SESSION["openid"];
$message=$_POST["message"];

if($openid!="" && $message!=""){
	$mysql = new SaeMysql();
	//判断是否刷屏
	$sql = "select * from wechatwall where openid='$openid' and message='$message'";
	$data = $mysql->getData( $sql );
	if(count($data)>=2){
		echo "fail";
		$mysql->closeDb();
		exit();
	}else{
		$sql="insert into wechatwall(openid,message,status) values('$openid','$message',0)";
    	$mysql->runSql( $sql );
		echo "success";
	}
	$mysql->closeDb();
}

?>