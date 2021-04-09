<?php
session_start();
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_wallet.php');
require_once(incl_path.'gffunc_pit.php');
require_once(incl_path.'gffunc_packet.php');
require_once(incl_path.'gffunc_member.php');
//-----------------------------------------
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.template.php');
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
define('ISHOME',true);
$tmp=new CLS_TEMPLATE();
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
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic">
	<link rel="shortcut icon" href="#" type="image/x-icon">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo ROOTHOST; ?>global/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo ROOTHOST; ?>global/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo ROOTHOST; ?>global/css/style.css">
	<script src='<?php echo ROOTHOST;?>global/js/jquery-1.11.2.min.js'></script>
	<script src="<?php echo ROOTHOST;?>global/js/bootstrap.min.js"></script>
</head>
<body >
<?php
$username=getInfo('username');
?>
<div class="body">
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="tab" href="#payment">PAYMENT</a></li>
		<li><a data-toggle="tab" href="#qr-payment">QR-Code</a></li>
	</ul>
	<div class="tab-content">
		<div id="payment" class="tab-pane fade in active">
			<h3>HOME</h3>
			<p>Some content.</p>
		</div>
		<div id="qr-payment" class="tab-pane fade">
			<div class='text-center'>
			<?php
			$arr=array();
			$wallet='121212112';
			$arr['wallet']=$wallet;
			$arr['rate']=0.3;
			$data=encrypt(json_encode($arr,JSON_UNESCAPED_UNICODE)).'|'.$wallet;
			?>
			<img src='https://chart.googleapis.com/chart?cht=qr&choe=UTF-8&chs=300x300&chl=<?php echo $data;?>'/>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id='myModal' role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="data-frm">
				<p>One fine body&hellip;</p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
<script>
function fixPanel(){
	var htop=$('#site-header')!=undefined?$('#site-header').outerHeight():0;
	var _h=$(window).innerHeight();
	console.log(_h);
	$('.main-panel').height(_h-htop);
}
$('document').ready(function(){
	fixPanel();
	$(window).resize(function(){
		fixPanel();
	})
	$('#nav_logout').click(function(){
		$.get('<?php echo ROOTHOST;?>ajaxs/mem/logout.php',function(req){
			location.href='<?php echo ROOTHOST;?>';
			return false;
		});
	});
});
</script>
</html>