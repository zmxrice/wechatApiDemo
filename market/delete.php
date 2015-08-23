<?php
session_start();
$openid=$_SESSION["openid"];
$id=$_GET["id"];

$s = new SaeStorage();
$mysql = new SaeMysql();
	
$sql="select filename from market where openid='$openid' and id='$id'";
$data = $mysql->getData( $sql );
$s->delete("upload",$data[0][filename]);

$sql="delete from market where openid='$openid' and id='$id'";
$mysql->runSql( $sql );


$mysql->closeDb();
echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
?>