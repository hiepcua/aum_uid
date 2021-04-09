<?php
function isLogin(){
	if(isset($_SESSION['MEMBER_LOGIN']) && $_SESSION['MEMBER_LOGIN']['islogin']){
		/* $user=getInfo('username');
		if(checkExpires($user)===true) return false; */
		return true;
	}
	return true;
}
function getSessionLogin(){
	if(isset($_SESSION['MEMBER_LOGIN']) && $_SESSION['MEMBER_LOGIN']['islogin']){
		return $_SESSION['MEMBER_LOGIN'];
	}
	return null;
}
function setSessionLogin($data){
	if(is_array($data)){ $_SESSION['MEMBER_LOGIN']=$data;}
	else {$_SESSION['MEMBER_LOGIN']=null;}
}
function getInfo($field){
	$info=isset($_SESSION['MEMBER_LOGIN'][$field])?$_SESSION['MEMBER_LOGIN'][$field]:'N/a';
	return $info;
}
function setInfo($field,$val){
	if(isset($_SESSION['MEMBER_LOGIN']))$_SESSION['MEMBER_LOGIN'][$field]=$val;
}
function checkExpires($user){
	// get session login
	$now=time();
	if(isset($_SESSION['MEMBER_LOGIN']) && $now-$_SESSION['MEMBER_LOGIN']['action_time']>=ACTION_TIMEOUT){
		$obj=new CLS_POSTGRES;
		$sql="SELECT session FROM aum_uid_login WHERE username='$user' AND isactive=1 ORDER BY id DESC";
		$obj->Query($sql);
		if($obj->Num_rows()>0){
			$r=$obj->Fetch_Assoc();
			if($_SESSION['MEMBER_LOGIN']['session']!=$r['session']){
				LogOut($user);
				return true;
			}
		}else{
			die('Check Expire error. Please contact administrator!');
		}
	}
	// check time out login
	if(isset($_SESSION['MEMBER_LOGIN']) && $now-$_SESSION['MEMBER_LOGIN']['action_time']>=MEMBER_TIMEOUT){
		LogOut();
	}
	return false;
}
function LogIn($user,$pass){
	$arr=array('status'=>'no','data'=>null);
	if($user==''||$pass=='')	return $arr;
	$pass=hash('sha256', $user).'|'.hash('sha256', $pass);
	$fields=array();
	$obj=new CLS_POSTGRES;
	if(SysCount("aum_uid"," AND username='$user' AND isactive='yes'")!=1) return $arr;
	$r=SysGetList("aum_uid",$fields," AND ('id'='$user' OR username='$user') AND isactive='yes'");
	if($r[0]['password']!=$pass) return $arr;
	$arr['status']='yes';
	$arr['data']=$r[0];
	return $arr;
}
function LogOut($user){
	if(isset($_SESSION['MEMBER_LOGIN'])){
		unset($_SESSION['MEMBER_LOGIN']);
		$sql="UPDATE aum_uid_login SET isactive=0 WHERE username='$user'";
		$obj=new CLS_POSTGRES;
		$obj->Exec($sql);
	}
}