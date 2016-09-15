<?php
/*
 *QQ空间秒赞
*/
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$method=isset($_GET['method']) ? $_GET['method'] : 2;
$getss=null;
$newpc=0;
$sleep=isset($_GET['sleep']) ? $_GET['sleep'] : 0;
$forbid=isset($_GET['forbid']) ? $_GET['forbid'] : null;
if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


//执行刷赞
$forbid=explode('|',$forbid);
require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
if($method==2)
$qzone->like(0,$forbid,$sleep);
elseif($method==3)
$qzone->like(1,$forbid,$sleep);
elseif($method==4)
$qzone->like(2,$forbid,$sleep);

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