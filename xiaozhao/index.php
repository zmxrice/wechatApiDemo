<?php
$c = new SaeCounter();
if ($c->create('xiaozhao')){
	$c->set('xiaozhao',1);// 返回true
}else{
	$c->incr('xiaozhao'); // 返回101
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>
<body>
<div data-role="page" id="pageone">
    <div data-role="header" data-theme="b" data-position="fixed">
		<h1>就业快车</h1>
	</div>
  <div data-role="content">     
    <ul data-role="listview" data-inset="true" id="detail">
        
<?php
@header('Content-type: text/html;charset=UTF-8');
error_reporting(E_ALL);
include_once('simpleDom/simple_html_dom.php');

date_default_timezone_set('PRC');
$now=date("Y-m-d H:i:s", time());
$i=0;
$yu='http://jyzd.cumt.edu.cn';
while(true){
	$i++;
	$html = file_get_html('http://jyzd.cumt.edu.cn/index.php/Zhuanchanglist/zhuanchanglist/p/'.$i);
	foreach($html->find('tr') as $item){
		if($item->first_child()->tag=='td'){
			if($now>($item->children(2)->plaintext)){
				break 2;
			}else{
				$link=$item->find('a',0)->href;
                echo "<li><a href=".$yu.$link."><h1>".strip_tags($item->children(1)->plaintext)."</h1>";
                echo "<p>时间: ".strip_tags($item->children(2)->plaintext)."<br/ >";
                echo "地点: ".strip_tags($item->children(3)->plaintext)."</p></a></li>";
                
			}
		}
		
	}
}
?>
      </ul>
    </div>
</div>
</body>
</html>