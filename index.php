<?php
session_start(); ini_set('display_errors',1);
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
//-----------------------------------------
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.postgre.php');
require_once(libs_path.'GoogleAuthenticator.php');
//-----------------------------------------
header('Content-type: text/html; charset=utf-8');
header('Pragma: no-cache');
header('Expires: '.gmdate('D, d M Y H:i:s',time()+600).' GMT');
header('Cache-Control: max-age=600');
header('User-Cache-Control: max-age=600');
$req=isset($_GET['req'])?antiData($_GET['req']):'';
$req=str_replace(' ','%2B',$req);
if($req!='') setcookie('RES_USER',$req,time() + (86400 * 30), "/");

if(isset($_SESSION['CALL_BACK']) && $_SESSION['CALL_BACK']!='' && isLogin()){
	$callBack=$_SESSION['CALL_BACK'];
	$ulogin=json_encode(getSessionLogin(),JSON_UNESCAPED_UNICODE);
	if(strpos($callBack,'?')) $callBack.='&r='.$ulogin;
	else $callBack.='?r='.$ulogin;
	unset($_SESSION['CALL_BACK']);	
	header('location:'.$callBack);
}else{
	$callBack=isset($_GET['callback'])?antiData($_GET['callback']):'';
	$_SESSION['CALL_BACK']=$callBack;
}
define('ISHOME',true);
$_COM=isset($_GET['com'])?addslashes(strip_tags($_GET['com'])):'';
$_VIEW=isset($_GET['viewtype'])?addslashes(strip_tags($_GET['viewtype'])):'';
?>
<!DOCTYPE html>
<html lang='vi'>
<head profile="http://www.w3.org/2005/10/profile">
	<meta charset="utf-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="Content-Language" content="vi" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="referrer" content="no-referrer" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo SITE_NAME;?></title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic">
	<link rel="shortcut icon" href="#" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>css/style.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>css/style.responsive.min.css"/>
	<script src='<?php echo ROOTHOST;?>global/js/jquery-1.11.2.min.js'></script>
	<script src="<?php echo ROOTHOST;?>global/js/bootstrap.min.js"></script>
</head>
<body id="wapper_body" class="wapper_body">
<?php if(isLogin()){ ?>
<div id="notification" style="display: none;"></div>
<div id='site_header'><?php require_once('modules/site-header.php');?><div class="clearfix"></div></div>
<?php } ?>
<div id='wapper' class="body">
<?php
	$com=isset($_GET['com'])? addslashes($_GET['com']):'frontpage';
	$viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'';
	include(COM_PATH.'com_'.$com.'/layout.php');
?>
</div>
<?php if(isLogin()){ ?>
<div id='site-footer'><?php //require_once('modules/site-footer.php');?></div>
<div class="modal fade" id='myModal' role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="data-frm">
				<p>One fine body&hellip;</p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }?>
</body>
</html>