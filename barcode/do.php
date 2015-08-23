<?php
error_reporting(E_ALL);
$mydate=$_POST["mydate"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx87470e2cc88e1c27&secret=ad0f0f1642abdc1c194c620ca626dcdb");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$mytoken = json_decode(curl_exec($ch));
if(curl_error($ch)){
	print curl_error($ch);
}
curl_close($ch);

$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$mytoken->{'access_token'};
$post_data = "{\"action_name\": \"QR_LIMIT_SCENE\", \"action_info\": {\"scene\": {\"scene_id\": ".$mydate."}}}";

$mych = curl_init();
curl_setopt($mych, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($mych, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($mych, CURLOPT_URL, $url);
curl_setopt($mych, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($mych, CURLOPT_POST, 1);
curl_setopt($mych, CURLOPT_POSTFIELDS, $post_data);
$ticket = json_decode(curl_exec($mych));
$myticket=$ticket->{'ticket'};
if(curl_error($mych)){
	print curl_error($mych);
}
curl_close($mych);

$home_url="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$myticket;
echo "<script language=\"javascript\">";
echo "location.href=\"$home_url\"";
echo "</script>";
?>