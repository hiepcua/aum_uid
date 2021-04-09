<?php
session_start();
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
$_API_SOURCE = 'http://loichoi.com/AUM/uid/login.php';
$_CALL_BACK	= 'http://uid.aumsys.net/login_callback.php';
$user='nxtuyen.pro@gmail.com';
$pass='123456';
$sig = hash(
	'sha256',
	$user.$pass,
	APP_SECRET
);
$source = parse_url($_API_SOURCE);
$target =in_array($source['host'], $_HOST_LIST)?'http://'.$source['host'].$source['path']:'';
if($target!=''){
	$_SESSION['SESSION_LOGIN']=time();
	$url=$target.'?'.'user='.urlencode($user).'&pass='.urlencode($pass).'&sourse='.urlencode($_CALL_BACK).'&sig='.urlencode($sig);
	header('location:'.$url);
}else{
	die('Api source is empty!');
}