<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<title>统计结果</title>
</head>
<body>

<div data-role="page">

  <div data-role="content">
   <div class="ui-grid-a">
     <div class="ui-block-a">
<?php
$mysql = new SaeMysql();
$sql = "select distinct name, num from counter order by num+0 desc";
$data = $mysql->getData( $sql );
if($data==NULL){
	echo "暂无记录！";
}else{
	echo "<h4>标签点击量</h4>";
	for ($i=0;$i<count($data);$i++){
		echo "<p>".$data[$i][name].": ".$data[$i][num]."</p>";
	}
}
		
$mysql->closeDb();
?>
     </div>
     <div class="ui-block-b">
<?php
echo "<h4>内容阅读量</h4>";
$c = new SaeCounter();
$result = array();
if (!$c->create('activity')){
	$result["精彩活动"] = $c->get('activity');
}
if (!$c->create('phone')){
	$result["办公电话"] = $c->get('phone');
}
if (!$c->create('jiangzuo')){
	$result["校园学术"] = $c->get('jiangzuo');
}
if (!$c->create('xiaozhao')){
	$result["就业快车"] = $c->get('xiaozhao');
}
if (!$c->create('xiaoche')){
	$result["校车班次"] = $c->get('xiaoche');
}
if (!$c->create('xiaoli')){
	$result["校历日程"] = $c->get('xiaoli');
}
if (!$c->create('market')){
	$result["跳蚤市场"] = $c->get('market');
}
if (!$c->create('lost')){
	$result["失物招领"] = $c->get('lost');
}
if (!$c->create('manual')){
	$result["使用手册"] = $c->get('manual');
}
arsort($result,SORT_NUMERIC);
foreach($result as $key=>$value){
    echo "<p>".$key.": ".$value."</p>";
}
?>
     </div>
   </div>
</div> 
</body>
</html>