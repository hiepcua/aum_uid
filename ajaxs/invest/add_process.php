<?php
session_start(); ini_set('display_errors',1);
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_binance.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
if(isLogin()){
	$username=getInfo('username');
	$isexpire=getInfo('isexpire');
	if($isexpire!='yes'){
		$AllMarkets=getAllMarket();
		$_curPrice=array();
		foreach($AllMarkets as $item){
			$_curPrice[$item['symbol']]=$item['price'];
		}
		
		$arr=array();
		$arr['username']=$username;
		$arr['id_group']=antiData(str_replace('G','',$_POST['group']));
		$arr['coina']=antiData($_POST['coina']);
		$arr['coinb']=antiData($_POST['coinb']);
		$arr['quana']=antiData($_POST['quana'],'float');
		$arr['quanb']=antiData($_POST['quanb'],'float');
		$arr['quanb']+=0;
		$arr['unit']=$arr['quana'];
		if($arr['quanb']>0){ // cộng thêm phần lượng của coinb
			$symboll=$arr['coinb'].$arr['coina'];
			$arr['unit']+=$arr['quanb']*$_curPrice[$symboll];
		}
		$arr['min_price']=antiData($_POST['minprice'],'float');
		$arr['rate_sell']=antiData($_POST['ratesell'],'int');
		$arr['rate_buy']=antiData($_POST['ratebuy'],'int');
		$arr['rate_more']=antiData($_POST['ratemore'],'int');
		$arr['cdate']=time();
		$arr['isactive']='no';
		SysAdd('tbl_invests',$arr);
		echo 'success';
	}else{
		echo 'Your account has expired, please renew it to continue using it';
	}
} 
die();
?>