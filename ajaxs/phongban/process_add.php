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
	if(isset($_POST['txt_code']) && $_POST['txt_code']!='') {
		$arr=array();
		$arr['code'] = antiData($_POST['txt_code']);
		$arr['name'] = isset($_POST['txt_name']) ? antiData($_POST['txt_name']) : '';
		$arr['isactive'] = 1;
		$arr['cdate'] = time();

		$result = SysAdd('tbl_group', $arr);
		if($result){
			die('1');
		}else{
			die('0');
		}
	}
}
?>