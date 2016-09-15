<?php
require 'qq.inc.php';

$qq=isset($_GET['qq']) ? $_GET['qq'] : null;
$skey=isset($_GET['skey']) ? $_GET['skey'] : null;
$pskey=isset($_GET['pskey']) ? $_GET['pskey'] : null;

if($qq && $skey && $pskey){}else{echo"<font color='red'>输入不完整!<a href='javascript:history.back();'>返回重新填写</a></font>";exit;}

require_once 'qzone.class.php';
$qzone=new qzone($qq,$sid,$skey,$pskey);
$url = 'http://r.qzone.qq.com/cgi-bin/user/qzone_cgi_msg_getcnt2?uin='.$qq.'&bm=0800950000008001&v=1&g_tk='.$qzone->gtk2.'&g=0.291287'.time();
$data=$qzone->get_curl($url,0,'http://cnc.qzs.qq.com/qzone/v6/setting/profile/profile.html',$qzone->cookie);
preg_match('/\_Callback\((.*?)\);/is',$data,$json);
$arr=json_decode($json[1], true);

if($arr['error']==4004){
	echo 'SKEY已失效！';
	sendsiderr($qq,$skey,'skey');
}else
echo '执行完毕！SKEY正常';
?>