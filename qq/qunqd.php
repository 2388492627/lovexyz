<?php
/*
 *群签到
*/

require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$forbid=isset($_GET['forbid']) ? $_GET['forbid'] : null;
$lat=isset($_GET['lat']) ? $_GET['lat'] : 0;
$lgt=isset($_GET['lgt']) ? $_GET['lgt'] : 0;

if($qq && $skey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}

$forbid=explode("|",$forbid);
require_once 'qqsign.class.php';
$qzone=new qqsign($qq,$sid,$skey);
$qzone->qunqd($forbid,$lat,$lgt);

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