<?php
//随机昵称

require 'qq.inc.php';


$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;
$content=isset($_GET['content']) ? $_GET['content'] : null;


if($qq && $skey && $pskey && $content){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}


require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
$array=explode('|',$content);
$nick=$array[array_rand($array,1)];
$qzone->setnick($nick);

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