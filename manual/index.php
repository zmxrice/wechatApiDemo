<?php
$c = new SaeCounter();
if ($c->create('manual')){
	$c->set('manual',1);// 返回true
}else{
	$c->incr('manual'); // 返回101
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>使用手册</title>
</head>

<body>
<img src="1.png" width="100%" style="margin-top:5px;" /><br/>
<img src="2.png" width="100%" /><br/>
<img src="3.png" width="100%" /><br/>
<img src="4.png" width="100%" /><br/>
<img src="5.png" width="100%"/>
</body>
</html>
