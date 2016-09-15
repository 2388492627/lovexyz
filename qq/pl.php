<?php
/*
 *QQ空间说说秒评
*/
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$method=isset($_GET['method']) ? $_GET['method'] : 2;
$content=isset($_GET['content']) ? $_GET['content'] : null;
$image=isset($_GET['img']) ? $_GET['img'] : null;
$forbid=isset($_GET['forbid']) ? $_GET['forbid'] : null;
$only=isset($_GET['only']) ? $_GET['only'] : null;
$getss=null;
$sleep=isset($_GET['sleep']) ? $_GET['sleep'] : 0;
if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


//执行秒评
if(preg_match("/\[随机\]/",$content) || $content==''){
	$str = @file_get_contents('sji.db');
	$content = explode('|',$str);
}else{
	$content=explode('|',$content);
}
$forbid=explode('|',$forbid);
$only=explode('|',$only);
require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
if($method==2)
$qzone->reply(0,$content,$forbid,$only,$sleep);
elseif($method==3)
$qzone->reply(1,$content,$forbid,$only,$sleep,$image);

//结果输出
if($isdisplay){
	foreach($qzone->msg as $result){
		echo $result.'<br/>';
	}
}

//SKEY失效通知
if($qzone->skeyzt){
	sendsiderr($qq,$skey,'skey');
}
?>
