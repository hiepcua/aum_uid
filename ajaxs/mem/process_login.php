<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
$arr=array();
$arr['username']=isset($_POST['username'])?antiData($_POST['username']):'';
$arr['ischeck']=isset($_POST['ischeck'])?antiData($_POST['ischeck']):'no';
$arr['time']=time();
$password=isset($_POST['password'])?antiData($_POST['password']):'';
unset($_POST);

if($arr['username']=='' || $password=='') die('Username and Password are empty');
$arr['password']=$password;
$data=array();
$data['data']=encrypt(json_encode($arr),PIT_API_KEY);
$url=ROOTHOST.'api/member/login';
$rep=Curl_Post($url,json_encode($data));
if($rep==null || $rep['status']=='no') die('Login failed');
else{
	if($arr['ischeck']=='yes') setcookie('LOGIN_USER',encrypt(json_encode($arr)),time() + (86400 * 30), "/");
	$session=$cdate=time();
	$rep['session']=$session;
	$rep['action_time']=$cdate;
	$rep['islogin']=true;
	setSessionLogin($rep);
	die('success');
}
unset($data);
unset($rep);
unset($arr);