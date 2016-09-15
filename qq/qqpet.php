<?php
/*
 *宠物挂机
*/
require 'qq.inc.php';
$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;

if($qq && $skey){
}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}

include_once "qqsign.class.php";
$qzone=new qqsign($qq,$sid,$skey);
$qzone->qqpet();

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