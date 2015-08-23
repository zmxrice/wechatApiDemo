<?php
$c = new SaeCounter();
if ($c->create('xiaoche')){
	$c->set('xiaoche',1);// 返回true
}else{
	$c->incr('xiaoche'); // 返回101
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>班车查询</title>
</head>

<body style="padding:0; margin:0">
<img src="bus.jpg" width="100%"/>
</body>
</html>
