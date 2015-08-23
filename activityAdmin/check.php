<?php
session_start();
$username=$_POST["depname"];
$password=$_POST["depass"];

$mysql = new SaeMysql();
$sql = "select * from actadmin where username='$username' and password='$password'";
$data = $mysql->getData( $sql );
if(!$data==NULL){
	echo "success";	
	if(!isset($_SESSION["user"])){
        $_SESSION["user"]=$username;
    }
}else{
	echo "fail";
}
$mysql->closeDb();
?>