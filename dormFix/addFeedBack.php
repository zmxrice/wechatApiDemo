<?php
session_start();
$openid=$_SESSION["openid"];
$id=$_POST["id"];
$feedback=$_POST["feedback"];

if($openid!="" && $id!="" && $feedback!=""){
	$mysql = new SaeMysql();
	
	$sql="update fixinfo set feedback='$feedback', isfinished=1 where id='$id' and openid='$openid'";
    $mysql->runSql( $sql );
	if( $mysql->errno() == 0 ){
		echo "success";
	}
	$mysql->closeDb();
}

?>