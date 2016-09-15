<?php
/*
 *圈说说图
*/
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;

if($qq && $skey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
$qzone->quantu();

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