<?php
session_start();
$openid=$_SESSION["openid"];

if($openid!=""){
	$mysql = new SaeMysql();

	$sql = "select * from userinfo where openid='$openid'";
	$data = $mysql->getData( $sql );
	if(count($data)>0){
		$sql="select * from fixinfo where openid='$openid' and isfinished=0";
		$re = $mysql->getData( $sql );
		if(count($re)>0){
			$result=array();
			for ($i=0;$i<count($re);$i++){
           		array_push($result,array("nickname"=>$data[0][nickname],"id"=>$re[$i][id],"phone"=>$re[$i][phone],"dorm"=>$re[$i][dorm],"title"=>$re[$i][title],"message"=>$re[$i][message]));
			}//for
			echo json_encode($result);
		}//if $re
	
	}//if $data
	$mysql->closeDb();
}

?>