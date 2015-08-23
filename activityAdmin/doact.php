<?php
session_start();
$user=$_SESSION["user"];
$type=$_GET["type"];
$dotype=$_POST["dotype"];
$actype=$_POST["actype"];

$mysql = new SaeMysql();
if($type=="init"){
	$result=array();
	$sql="";
	if ($user==="cumtadmin"){
		$sql = "select * from activity order by id+0 desc";
	}else{
		$sql = "select * from activity where user='$user'";
	}
	$data = $mysql->getData( $sql );
	for ($i=0;$i<count($data);$i++){
		array_push($result,array("id"=>$data[$i][id],"name"=>$data[$i][name]));
	}
	echo json_encode($result);

}
if($actype=="del"){
    $delid=$_POST["delid"];
    $sql="delete from activity where id='$delid'";
    $mysql->runSql( $sql );
}
else if($actype=="edt"){
    $edtresult=array();
    $edtid=$_POST["edtid"];
    $sql="select * from activity where id='$edtid'";
    $data = $mysql->getData( $sql );
    for ($i=0;$i<count($data);$i++){
       array_push($edtresult,array("id"=>$data[$i][id],"name"=>$data[$i][name],"day"=>$data[$i][day],"location"=>$data[$i][location],"dep"=>$data[$i][dep],"detail"=>$data[$i][detail]));
	}
	echo json_encode($edtresult);
}
if($dotype=="add"){
    $fullname=$_POST["fullname"];
    $day=$_POST["day"];
    $location=$_POST["location"];
    $dep=$_POST["dep"];
    $detail=$_POST["detail"];
    
    $sql="insert into activity(name,day,location,dep,detail,user) values('$fullname','$day','$location','$dep','$detail','$user')";
    $mysql->runSql( $sql );
}
else if($dotype=="edt"){
    $edtid=$_POST["edtid"];
    $fullname=$_POST["edt_fullname"];
    $day=$_POST["edt_day"];
    $location=$_POST["edt_location"];
    $dep=$_POST["edt_dep"];
    $detail=$_POST["edt_detail"];
    
    $sql="update activity set name='$fullname',day='$day',location='$location',dep='$dep',detail='$detail' where id='$edtid'";
    $mysql->runSql( $sql );
}

$mysql->closeDb();
?>