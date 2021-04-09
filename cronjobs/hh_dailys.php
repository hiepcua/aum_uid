<?php
define('incl_path','../global/libs/');
define('libs_path','../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_packet.php');
require_once(libs_path.'cls.mysql.php');
$hour=date('H');//die();
//if($hour<1 && $hour>2) die();
Bonus_Daily();
die();
?>