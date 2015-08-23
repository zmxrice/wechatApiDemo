<?php
$id=$_GET["id"];
$mysql = new SaeMysql();

$sql = "select * from lostseek where id='$id'";
$data = $mysql->getData( $sql );

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<script language="javascript">

    function check(){
        var title=$("#title").val();
        var contact=$("#contact").val();
        var info=$("#info").val();
        if (title==""){
            $("#warn").text("请输入物品名称");
            return false;
        }else if(contact==""){
            $("#warn").text("请输入联系方式");
            return false;
        }else if(info ==""){
            $("#warn").text("请输入简介");
            return false;
        }else{
            return true;
        }
    }
	
</script>
</head>
<body>
    
<div data-role="page" id="edit">
	<div data-role="header" data-theme="b" data-position="fixed">
		<h1>编辑详情</h1>
        <a href="showDetail.php?id=<?php echo $id;?>" data-role="button" data-icon="back"  rel="external">返回详情</a>
        <a href="delete.php?id=<?php echo $id;?>" data-role="button" data-icon="delete"  rel="external">删除本条</a>
	</div>
	<div data-role="content">
        <form action="doedit.php" method="post" enctype="multipart/form-data"  data-ajax="false">
            <input type="text" id="id" name="id" value="<?php echo $id;?>" style="display:none" />
            <fieldset data-role="controlgroup" data-type="horizontal">
            <?php 
			if ($data[0][status]=="捡到") {
				echo "<label for=\"sell\">丢失</label>";
          		echo "<input type=\"radio\" name=\"switch\" id=\"sell\" value=\"丢失\" />";
          		echo "<label for=\"buy\">捡到</label>";
          		echo "<input type=\"radio\" name=\"switch\" id=\"buy\" value=\"捡到\" checked />";
      			
			}else if ($data[0][status]=="丢失") {
				echo "<label for=\"sell\">丢失</label>";
          		echo "<input type=\"radio\" name=\"switch\" id=\"sell\" value=\"丢失\" checked />";
          		echo "<label for=\"buy\">捡到</label>";
          		echo "<input type=\"radio\" name=\"switch\" id=\"buy\" value=\"捡到\" />";
			}
            ?>   
    		</fieldset>
            
            <label for="title">物品名称</label>
            <input type="text" name="title" id="title" value="<?php echo $data[0][title];?>" />
            <label for="contact">联系方式</label>
            <input type="text" name="contact" id="contact" value="<?php echo $data[0][contact];?>" />
        	<label for="file">图片</label>
        	<input type="file" name="file" id="file" />
            <label for="info">物品简介</label>
            <textarea name="info" id="info"><?php echo $data[0][info];?></textarea>
        	<input type="submit" onclick="return check();" name="submit" value="提交" />
        </form>
        <p id="warn" style="color:red;"></p>
	</div>

</div>

<?php 
$mysql->closeDb();
?>
</body>
</html>