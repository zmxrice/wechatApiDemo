<?php
$id=$_GET["id"];
$mysql = new SaeMysql();

$sql = "select * from lostseek where id='$id'";
$data = $mysql->getData( $sql );
$sql="select * from userinfo where openid='".$data[0][openid]."'";
$re = $mysql->getData( $sql );
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
<div data-role="page" id="detail">
	<div data-role="header" data-theme="b" data-position="fixed">
        <a href="addMessage.php" data-role="button" data-icon="back" rel="external">返回列表</a>
		<h1>物品详情</h1>
        <a href="editDetail.php?id=<?php echo $id;?>" data-role="button" data-icon="gear"  rel="external">编辑详情</a>
        
	</div>
	<div data-role="content">
        <span style="font-weight:bold; font-size:18px">【<?php echo $data[0][status];?>】<?php echo $data[0][title];?></span> <br/>
        <span style="color:#696969;font-size:12px"><?php echo $data[0][addtime];?>  </span><span style="color:#2995C7;font-size:14px">发布人: <?php echo $re[0][nickname];?> </span>
        <?php if($data[0][image]!=""){?><img src="<?php echo $data[0][image];?>" width="100%"/><?php }?>
        <p>【联系方式】<?php echo $data[0][contact];?><br />
        【物品介绍】<?php echo $data[0][info];?></p>
	</div>

</div>

<?php 
$mysql->closeDb();
?>
</body>
</html>