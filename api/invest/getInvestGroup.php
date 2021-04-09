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
if($username!=''){
	$obj=SysGetList('tbl_invest_group',array(),"AND username='$username' ORDER BY id",false);
	$arrGroup=array();
	while($r=$obj->Fetch_Assoc()){
		$arrGroup['G'.$r['id']]=$r;
	}
	echo json_encode(array('status'=>'yes','data'=>$arrGroup),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('status'=>'no','mess'=>'Account is incorrect!'));
}
die();