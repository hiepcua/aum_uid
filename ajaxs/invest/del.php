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
	$id=antiData($_POST['id'],'int');
	SysDel('tbl_invests'," username='$username' AND id='$id'");
	echo 'success';
} 
die();
?>