<?php
$mysql = new SaeMysql();

$search=$_GET["search"];

if($search!=""){
	$result=array();
	$searchString=NULL;
	preg_match_all('/[\x{4e00}-\x{9fa5}]/u',$search,$string);
	$searchString=join('%',$string[0]);
	
	if($searchString!=""){
    	$searchString='%'.$searchString.'%';
		$sql="select distinct dep from phone where dep like N'$searchString'";
		$data = $mysql->getData( $sql );
		if(count($data)>0){
			for ($i=0;$i<count($data);$i++){
            	array_push($result,array("dep"=>$data[$i][dep]));
			}
		}
    	echo json_encode($result);
	}
}

$mysql->closeDb();
?>