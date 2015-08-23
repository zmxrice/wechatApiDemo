<?php
$mysql = new SaeMysql();

$dep=$_GET["dep"];


if($dep!=""){
	$re=array();
	$sql="select * from phone where dep='$dep'";
	$data = $mysql->getData( $sql );
	if(count($data)>0){
		for ($i=0;$i<count($data);$i++){
            array_push($re,array("office"=>$data[$i][office],"ph_num"=>$data[$i][ph_num]));
		}
	}
    echo json_encode($re);
}


$mysql->closeDb();
?>