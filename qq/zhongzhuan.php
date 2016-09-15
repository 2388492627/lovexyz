<?php
//QQ邮箱中转站一键续期
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$superkey=isset($_GET['superkey']) ? $_GET['superkey'] : null;

if($qq && $skey && $superkey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}

require_once 'qqsign.class.php';
$qzone=new qqsign($qq,$sid,$skey);
$qzone->zhongzhuan($superkey);

//结果输出
if($isdisplay){
	foreach($qzone->msg as $result){
		echo $result.'<br/>';
	}
}
?>