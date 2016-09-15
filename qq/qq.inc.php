<?php
error_reporting(0);

function curl_get($url)
{
$ch=curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$content=curl_exec($ch);
curl_close($ch);
return($content);
}

function sendsiderr($qq,$skey,$err='skey')
{
global $backurl;
curl_get($backurl.'api.php?my=siderr&qq='.$qq.'&skey='.$skey.'&err='.$err);
}

@set_time_limit(0);
ignore_user_abort(true);
header("content-Type: text/html; charset=utf-8");

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/qq/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

$referer = substr($_SERVER['HTTP_REFERER'], 0, strrpos($_SERVER['HTTP_REFERER'], '/')).'/';

$backurl=strpos($_SERVER['HTTP_REFERER'],'index.php?mod=')?$referer:$_GET['backurl'];
$backurl=empty($backurl)?$siteurl:urldecode($backurl);

if(file_exists('allowlist.txt')){
$allowurl=file_get_contents('allowlist.txt');
$allowurl=str_replace(array("\r\n", "\r", "\n"), "[br]",$allowurl);
$allowurl=explode("[br]",$allowurl);

if(!isset($_GET['runkey']))$isdisplay=true;

if(!in_array($backurl,$allowurl))
exit('抱歉，您的站点 '.$backurl.' 未经授权，无法使用当前QQ挂机类API！请联系API服务器管理员授权，或到后台的挂机模块API配置中将“QQ挂机类是否使用官方API”改为本地API。');
}
?>