<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(libs_path.'cls.postgre.php');
$json 	= json_decode(file_get_contents('php://input'),true);
$data	= json_decode(decrypt($json['data'],PIT_API_KEY),true);
$username	=antiData(data['username']);
$id			=antiData(data['id'],'int');
if($username!=''){
	SysDel('tbl_invests'," username='$username' AND id='$id'");
	echo json_encode(array('status'=>'yes','mess'=>'success'));
}else{
	echo json_encode(array('status'=>'no','mess'=>'Account is incorrect!'));
}
die();