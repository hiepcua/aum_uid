<?php
session_start(); ini_set('display_errors',1);
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
$user=isset($_GET['user'])?antiData($_GET['user']):'';
$pass=isset($_GET['pass'])?antiData($_GET['pass']):'';
$sig=isset($_GET['sig'])?antiData($_GET['sig']):'';
$callback=isset($_GET['sourse'])?antiData($_GET['sourse']):'';
unset($_GET);
$source = parse_url($callback);
if(!in_array($source['host'], $_HOST_LIST)) die('you are not permission!');
if(!isLogin()){
	if($user!='' && $pass!=''){
		if(hash_equals(hash('sha256', $user.$pass, APP_SECRET), $sig)) {
			$req=LogIn($user,$pass);
			
			if(!is_array($req) || $req['status']=='no'){ 
				$sig = hash(
					'sha256',
					 $user.$pass.'no',
					 APP_SECRET
				);
				$target ='http://'.$source['host'].$source['path'];
				header('Location: '.$target.'?'.'user='.urlencode($user).'&pass='.urlencode($pass).'&status=no&sig='.urlencode($sig));
			}else{
				$req['data']['islogin']=true;
				setSessionLogin($req['data']);
				$sig = hash(
					'sha256',
					 $user.$req['data']['password'].'yes',
					 APP_SECRET
				);	
				$target ='http://'.$source['host'].$source['path'];
				header('Location: '.$target.'?'.'user='.urlencode($user).'&pass='.urlencode($req['data']['password']).'&status=yes&sig='.urlencode($sig));
			}
		}
	}else{
		die('user or password is empty!');
	}
}else{
	$req=getSessionLogin();
	$sig = hash(
		'sha256',
		 $req['username']. $req['password'].'yes',
		 APP_SECRET
	);
	$target ='http://'.$source['host'].$source['path'];
	echo $target;
	header('Location: '.$target.'?'.'user='.urlencode($user).'&pass='.urlencode($req['password']).'&status=yes&sig='.urlencode($sig));
}
?>