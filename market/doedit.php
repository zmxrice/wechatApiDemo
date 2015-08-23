<?php
session_start();
$openid=$_SESSION["openid"];

$switch=$_POST["switch"];
$id=$_POST["id"];
$title=$_POST["title"];
$contact=$_POST["contact"];
$info=$_POST["info"];

$file = $_FILES["file"];
$fname = $_FILES["file"]["name"];
$fname_array = explode('.',$fname);
$extend = $fname_array[count($fname_array)-1];
$uptypes = array( 'jpg','jpeg','png','pjpeg','gif','bmp','x-png');
if($extend!=""){
    if(!in_array($extend,$uptypes)){
        echo "image only!";
        exit;
    }else{
    	$s = new SaeStorage();
    	$img = new SaeImage();
		$img_data = file_get_contents($file['tmp_name']);//获取本地上传的图片数据
		$img->setData($img_data);
        $img->resize(300);
		$img->improve();//提高图片质量的函数
    	$new_data = $img->exec();
		$temp_name = time().".".$extend;
    	$s->write('upload',$temp_name,$new_data);
        
        $image="http://zhumx-upload.stor.sinaapp.com/".$temp_name;
       
        $mysql = new SaeMysql();
        
        $sql="select filename from market where openid='$openid' and id='$id'";
        $data = $mysql->getData( $sql );
        $s->delete("upload",$data[0][filename]);
        
        $sql="update market set status='$switch', title='$title', contact='$contact', image='$image', filename='$temp_name', info='$info' where openid='$openid' and id='$id'";
	
    	$mysql->runSql( $sql );
		$mysql->closeDb();
        echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
	}
}else{
	$s = new SaeStorage();
    $mysql = new SaeMysql();
	
	$sql="select filename from market where openid='$openid' and id='$id'";
    $data = $mysql->getData( $sql );
    $s->delete("upload",$data[0][filename]);
    
    $sql="update market set status='$switch', title='$title', contact='$contact', image=NULL, filename=NULL, info='$info' where openid='$openid' and id='$id'";
    $mysql->runSql( $sql );
    
	$mysql->closeDb();
    echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
}
?>