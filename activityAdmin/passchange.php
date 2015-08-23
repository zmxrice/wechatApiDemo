<?php
session_start();
$username=$_SESSION["user"];
$password=$_POST["old_pass"];
$newpass=$_POST["new_pass"];

$mysql = new SaeMysql();
$sql = "select * from actadmin where username='$username' and password='$password'";
$data = $mysql->getData( $sql );
if(!$data==NULL){
	echo "success";
	$sql="update actadmin set password='$newpass' where username='$username'";
	$mysql->runSql( $sql );
	session_destroy();
}else{
	echo "fail";
}
$mysql->closeDb();
?>