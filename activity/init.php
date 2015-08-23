<?php
$mysql = new SaeMysql();

date_default_timezone_set('PRC');
$now=date("Y-m-d", time());

$result=array();
$sql="select * from activity order by id+0 desc";
$data = $mysql->getData( $sql );
if(count($data)>0){
	for ($i=0;$i<count($data);$i++){
        if($now<=$data[$i][day]){
            array_push($result,array("id"=>$data[$i][id],"name"=>$data[$i][name],"day"=>$data[$i][day],"location"=>$data[$i][location],"dep"=>$data[$i][dep],"detail"=>$data[$i][detail]));
        }
	}
}
echo json_encode($result);

$mysql->closeDb();
?>