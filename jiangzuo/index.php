<?php
$c = new SaeCounter();
if ($c->create('jiangzuo')){
	$c->set('jiangzuo',1);// 返回true
}else{
	$c->incr('jiangzuo'); // 返回101
}
?>
<!DOCTYPE HTML>
<html>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>

<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<div data-role="page" id="pageone">
    <div data-role="header" data-theme="b" data-position="fixed">
		<h1>校园学术</h1>
	</div>
    
  <div data-role="content">
  	<ol data-role="listview">
<?php
@header('Content-type: text/html;charset=UTF-8');
error_reporting(E_ALL);
include_once('simpleDom/simple_html_dom.php');

$yu='http://www.cumt.edu.cn/';
$html = file_get_html('http://www.cumt.edu.cn/1178/list1.htm');
foreach($html->find('span.Article_Title a') as $item){
	echo '<li><a href='.$yu.$item->href.'>'.$item->plaintext.'</a></li>';
}
?>
	</ol>
  </div>
</div> 
</body>
</html>