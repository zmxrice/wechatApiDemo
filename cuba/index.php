<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>抢票结果</title>
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>
<style>
table{
	border-collapse: collapse;
	table-layout:fixed;
	text-align:center;
	width:300px;
	font-size:14px;
	border-width: 1px;
	border-color: #666666;
}
th, td{
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
}
</style>
<body>
<div data-role="page" id="pageone">
    <div data-role="content" align="center">
    <img src="logo.jpg" width="300px" height="200px"/>
    	<table>
        <tr><th>姓名</th><th>学院</th><th>班级</th></tr>
<?php
$mysql = new SaeMysql();

$sql="select * from cuba order by dep, name";
$data = $mysql->getData( $sql );
if(count($data)>0){
	for ($i=0;$i<count($data);$i++){
		 echo "<tr><td>".$data[$i][name]."</td>";
		 echo "<td>".$data[$i][dep]."</td>";
		 echo "<td>".$data[$i][banji]."</td></tr>";
	}
}
$mysql->closeDb();
?>
        </table>
    </div>
</div>
</body>
</html>