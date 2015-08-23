<?php
session_start();
$openid=$_SESSION["openid"];
$phone=$_POST["phone"];
$title=$_POST["title"];
$message=$_POST["message"];
$dorm = $_POST["dorm"];

if($openid!="" && $phone!="" && $message!="" && $dorm!="" && $title!=""){
	$mysql = new SaeMysql();
	
	$sql="insert into fixinfo(openid,phone,dorm,title,message,isfinished) values('$openid','$phone','$dorm','$title','$message',0)";
    $mysql->runSql( $sql );
	if( $mysql->errno() == 0 ){
		echo "success";
	}
	$mysql->closeDb();
}

?>