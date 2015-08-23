<?php
session_start();
$openid=$_SESSION["openid"];

$mytime=date('Y-m-d H:i:s', time()); 

$switch=$_POST["switch"];
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
	
		$sql="insert into market(openid,status,title,contact,image,filename, info,addtime, isfinished) values('$openid','$switch','$title','$contact','$image','$temp_name','$info','$mytime',0)";
    	$mysql->runSql( $sql );
		$mysql->closeDb();
        echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
	}
}else{
    $mysql = new SaeMysql();
    
    $sql="insert into market(openid,status,title,contact,info,addtime, isfinished) values('$openid','$switch','$title','$contact','$info','$mytime',0)";
    $mysql->runSql( $sql );
    
	$mysql->closeDb();
    echo "<script>window.location.href='addMessage.php';</script>";//redirect to addMessage
}
?>