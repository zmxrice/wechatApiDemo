<?php
$mysql = new SaeMysql();
$num=$_GET["num"];

$sql = "select * from wechatwall where (id+0)>($num+0) and status=0 order by id asc limit 1";
$data = $mysql->getData( $sql );
if(count($data)>0){
	$result=array();
	$sql="select * from userinfo where openid='".$data[0][openid]."'";
	$update = "update wechatwall set status=1 where id='".$data[0][id]."'";
	$mysql->runSql( $update );
	$re = $mysql->getData( $sql );
	if(count($re)>0){
		array_push($result,array("nickname"=>$re[0][nickname],"headimgurl"=>$re[0][headimgurl],"id"=>$data[0][id],"message"=>$data[0][message]));			
	}//if $re

	echo json_encode($result);
	
}//if $data

$mysql->closeDb();
?>