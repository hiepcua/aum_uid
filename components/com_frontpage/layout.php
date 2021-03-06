<?php
if(!isLogin()){
$userCookie=isset($_COOKIE['LOGIN_USER'])?json_decode(decrypt($_COOKIE['LOGIN_USER']),true):array();
$user=isset($userCookie['username'])?$userCookie['username']:'';
$pass=isset($userCookie['password'])?$userCookie['password']:'';
$ischeck=isset($userCookie['ischeck']) && $userCookie['ischeck']=='yes'?'checked=true':'';
?>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel'>
		<div class='main'>
			<div class='frm'>
				<h3 class='title text-center'>AUM ID</h3>
				<div class='err_mess cred text-center'></div>
				<div class='form'>
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type='text' class='form-control' name='txt_user' id='txt_user' placeholder='AUMID or Username' value='<?php echo $user;?>' required/>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type='password' class='form-control' name='txt_pas' id='txt_pas' placeholder='password' value='<?php echo $pass;?>' required/> 
					</div>
					<div class="form-group">
						<label class="custom-control-label"><input type="checkbox" class="custom-control-input" id="isConfirm" <?php echo $ischeck;?>> Remember my account!</a>.</label>
					</div>
					<div class='form-group'>
						<button type='button' id='btn-process-login' class='btn btn-block btn-primary'>LOGIN IN</button>
					</div>
					<div class='form-group text-center'>
						<a href='<?php echo ROOTHOST;?>forgot-password'>Forgot your password?</a> 
						<a href='<?php echo ROOTHOST;?>register'>No account yet?</a>
					</div>
					<script>
					$('#txt_user').focus();
					$('#btn-process-login').click(function(){
						login();
					})
					$('#txt_user,#txt_pas').keyup(function(e){
						 var code = (e.keyCode ? e.keyCode : e.which);
						if (code==13) {
							e.preventDefault();
							login();
						}
					})
					function login(){
						if($('#txt_user').val()=='' || $('#txt_pas').val()=='' ){
							$('.err_mess').html('Username and Password are required');
							return;
						}
						$('.err_mess').html('');
						var _ischeck=$('#isConfirm').is(':checked')?'yes':'no';
						var _url='<?php echo ROOTHOST;?>ajaxs/mem/process_login.php';
						var _data={
							'username':$('#txt_user').val(),
							'password':$('#txt_pas').val(),
							'ischeck':_ischeck
						}
						$.post(_url,_data,function(req){
							console.log(req);
							if(req=='success'){
								window.location.reload();
							}else $('.err_mess').html(req);
						});
					}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<div class='col-sm-4'></div>
<?php	
}else{
global $_curPrice;
$username=getInfo('username');
$usd_equity=0;
$num_partners=0;
$num_members=0;
$num_contacts=0;
$num_abc=0;

?>
<div class="col-md-12"><div class="row report_box">
	<div class="col-md-3 col-xs-6">
		<div class="box bgred">
			<div class="heading">?????i t??c</div>
			<div class="content text-center">
				<div class="total"><?php echo number_format($num_partners,2);?></div>
				<div class="txt">T???ng t???t c??? ?????i t??c</div>
			</div>
			<div class="more"></div>
		</div>
	</div>
	<div class="col-md-3 col-xs-6">
		<div class="box bggreen">
			<div class="heading">Contacts</div>
			<div class="content text-center">
				<div class="col-xs-12">
					<div class="total"><?php echo number_format($num_contacts);?></div>
					<div class="txt">T???ng contacts</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="more"><a href="javascript:void(0);">Qu???n l?? contacts tuy???n sinh</a></div>
		</div>
	</div>
	<div class="col-md-3 col-xs-6">
		<div class="box bgorange">
			<div class="heading">H??? s?? h???c vi??n</div>
			<div class="content text-center">
				<div class="total"><?php echo number_format($num_members);?></div>
				<div class="txt">T???ng s??? h??? s?? h???c vi??n</div>
			</div>
			<div class="more"><a href="<?php echo ROOTHOST;?>orders">Qu???n l?? h??? s?? ????</a></div>
		</div>
	</div>
	<div class="col-md-3 col-xs-6">
		<div class="box bgblue">
			<div class="heading">Backup</div>
			<div class="content text-center">
				<div class="total"><?php echo 0;?> USDT</div>
				<div class="txt"><?php echo 0;?> Total backups</div>
			</div>
			<div class="more"><a href="#">Backup manager</a></div>
		</div>
	</div>
</div></div>
	
<?php
}
?>