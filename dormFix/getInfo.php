<?php
session_start();
$code=$_GET["code"];

if ($code!="authdeny"){
	$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx87470e2cc88e1c27&secret=ad0f0f1642abdc1c194c620ca626dcdb&code=".$code."&grant_type=authorization_code";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$result = json_decode(curl_exec($ch));
	$openid = $result->{'openid'};
	curl_close($ch);
	
	if ($openid!=""){
		//openid session
		if(!isset($_SESSION["openid"])){
			$_SESSION["openid"]=$result->{'openid'};
		}
	
		if(checkExist($openid)==0){
			$url="https://api.weixin.qq.com/sns/userinfo?access_token=".$result->{'access_token'}."&openid=".$openid."&lang=zh_CN";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$user = json_decode(curl_exec($ch));
		
			curl_close($ch);

			addUserInfo($openid,$user->{'nickname'},$user->{'sex'},$user->{'headimgurl'});
		}
		
		echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
	}
	
}//if $code!=""
else{
	echo "<script>window.location.href='error.php';</script>";//redirect to error
}

function checkExist($openid){
	$mysql = new SaeMysql();
	$sql = "select * from userinfo where openid='$openid'";
	$data = $mysql->getData( $sql );
	return count($data);		
	$mysql->closeDb();
}//function checkExist()

function addUserInfo($openid, $nickname, $sex, $headimgurl){
	$mysql = new SaeMysql();	
	$sql="insert into userinfo(openid,nickname,sex,headimgurl) values('$openid', '$nickname', '$sex', '$headimgurl')";
	$mysql->runSql( $sql );
	$mysql->closeDb();
}//function addRealInfo()

?>