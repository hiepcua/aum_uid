<?php
$COM='members';
$viewtype=isset($_GET['viewtype'])?addslashes($_GET['viewtype']):'viewtype';
if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
	include_once('tem/'.$viewtype.'.php');	
unset($viewtype); unset($obj); unset($COM);
?>