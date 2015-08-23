<?php
$mysql = new SaeMysql();

$sql = "select distinct openid from wechatwall";
$data = $mysql->getData( $sql );
if(count($data)>0){
    $result=array();
    for ($i=0;$i<count($data);$i++){
        $sql="select * from userinfo where openid='".$data[$i][openid]."'";
        $re = $mysql->getData( $sql );
        if(count($re)>0){
            array_push($result,array("nickname"=>$re[0][nickname],"headimgurl"=>$re[0][headimgurl],"openid"=>$data[$i][openid]));
        }
            
    }
    echo json_encode($result);
}	

$mysql->closeDb();


?>