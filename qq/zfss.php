<?php
//转发好友说说API

require 'qq.inc.php';
$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$uins=isset($_GET['uin']) ? $_GET['uin'] : null;
$content=isset($_GET['nr']) ? $_GET['nr'] : null;
$method=isset($_GET['method']) ? $_GET['method'] : 3;
$getss=null;
if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}

$uins=explode('|',$uins);

require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
if($method==2)
$qzone->zhuanfa(0,$uins,$content);
elseif($method==3)
$qzone->zhuanfa(1,$uins,$content);


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