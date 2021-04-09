<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
if(isLogin()){
	$username=getInfo('username');
	$isexpire=getInfo('isexpire');
	if($isexpire=='yes'){
		$id=antiData($_POST['id'],'int');
		$obj=SysGetList('tbl_invests',array('isactive'),"AND username='$username' AND id='$id'");
		$status=$obj[0]['isactive']=='yes'?'no':'yes';
		SysEdit('tbl_invests',array('isactive'=>$status)," username='$username' AND id='$id'");
		echo 'success'; 
	}else{
		echo 'Your account has expired, please renew it to continue using it';
	}
} 
die();
?>