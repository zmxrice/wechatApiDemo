<?php
$mysql = new SaeMysql();

$sql = "select * from market order by id+0 desc";
$data = $mysql->getData( $sql );
if(count($data)>0){
	$result=array();
    for ($i=0;$i<count($data);$i++){
		if ($data[$i][status]!="" && $data[$i][title]!=""){
        	array_push($result,array("id"=>$data[$i][id],"status"=>$data[$i][status],"title"=>$data[$i][title]));
		}
    }
    echo json_encode($result);
}//if $data


$mysql->closeDb();
?>