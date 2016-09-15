<?php
//自动发表图片说说API
require 'qq.inc.php';
require 'shuo.func.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$ua=isset($_GET['ua']) ? $_GET['ua'] : null;
$nr=isset($_GET['content']) ? $_GET['content'] : null;
$img=isset($_GET['img']) ? $_GET['img'] : null;
$method=isset($_GET['method']) ? $_GET['method'] : 2;
$delete=isset($_GET['delete']) ? $_GET['delete'] : null;

if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


if($nr=='语录' || $nr=='随机' || empty($nr))
$content=randstr();
elseif($nr=='笑话')
$content=jokei_txt();
elseif($nr=='时间')
$content=date("Y-m-d H:i:s");
elseif($nr=='表情')
$content="[em]e".rand(100, 204)."[/em]";
else $content=$nr;

if(strpos($content,'[随机]')!==false)
	$content=str_replace('[随机]',randstr(),$content);
if(strpos($content,'[笑话]')!==false)
	$content=str_replace('[笑话]',jokei_txt(),$content);
if(strpos($content,'[时间]')!==false)
	$content=str_replace('[时间]',date("Y-m-d H:i:s"),$content);
if(strpos($content,'[表情]')!==false)
	$content=str_replace('[表情]',"[em]e".rand(100, 204)."[/em]",$content);

if($img=='随机')
$imgurl = randimg();
elseif($img=='搞笑')
$imgurl = jokei_img();
else $imgurl=$img;


include_once "qzone.class.php";
	$qzone=new qzone($qq,$sid,$skey,$pskey);
	if($method==3){
		$qzone->shuo(1,$content,$imgurl,$ua,$delete);
	}else{
		$qzone->shuo(0,$content,$imgurl,$ua,$delete);
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