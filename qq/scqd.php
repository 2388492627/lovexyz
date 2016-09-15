<?php
/*
 *图书签到
*/
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$sid=isset($_GET['sid']) ? $_GET['sid'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;

if($qq && $sid){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


require_once 'qqsign.class.php';
$qzone=new qqsign($qq,$sid,$skey);
$qzone->scqd();

//结果输出
if($isdisplay){
	foreach($qzone->msg as $result){
		echo $result.'<br/>';
	}
}
?>