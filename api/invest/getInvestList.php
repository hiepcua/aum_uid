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
$username=antiData(data['username']);
$status=antiData(data['status']);
$page=antiData(data['page'],'int');
if($username!=''){
	$obj=SysGetList('tbl_invests',array(),"AND username='$username' ORDER BY coina",false);
	$arr=array();
	while($r = $obj->Fetch_Assoc()) {
		$arr[]=$r;
	}
	echo json_encode(array('status'=>'yes','data'=>$arr),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('status'=>'no','mess'=>'Account is incorrect!'));
}
die();