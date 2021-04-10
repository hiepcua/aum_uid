<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc_mysql.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.mysql1.php');
// require_once(libs_path.'cls.mysql.php');
// require_once(libs_path.'cls.postgre.php');

if(isLogin()){
	$code = antiData($_POST['code']);
	if($code !== ''){
		SysDel('tbl_group', " AND code='".$code."'");
		die('1');
	}else{
		die('0');
	}
}
?>