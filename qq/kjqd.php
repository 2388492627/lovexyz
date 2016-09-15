<?php
//空间自动签到API

require 'qq.inc.php';


require 'shuo.func.php';
$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$method=isset($_GET['method']) ? $_GET['method'] : 2;
$content=isset($_GET['content']) ? $_GET['content'] : null;



if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


if(strpos($content,'[随机]')!==false)
	$content=str_replace('[随机]',randstr(),$content);
if(strpos($content,'[笑话]')!==false)
	$content=str_replace('[笑话]',jokei_txt(),$content);
if(strpos($content,'[时间]')!==false)
	$content=str_replace('[时间]',date("Y-m-d H:i:s"),$content);
if(strpos($content,'[表情]')!==false)
	$content=str_replace('[表情]',"[em]e".rand(100, 204)."[/em]",$content);

require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
	if($method==3){
		$qzone->qiandao(1,$content);
	}else{
		$qzone->qiandao(0,$content);
	}

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