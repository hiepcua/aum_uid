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
				<h3 class='title text-center'>Login In</h3>
				<div class='err_mess cred text-center'></div>
				<div class='form'>
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type='text' class='form-control' name='txt_user' id='txt_user' placeholder='Email' value='<?php echo $user;?>' required/>
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
						<a href='<?php echo ROOTHOST;?>forgot-2fa'>Forgot your 2FA?</a>
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
							}else if(req=='2fa'){
								$('.frm').load('<?php echo ROOTHOST;?>/ajaxs/mem/frm_2fa.php');
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
	header('location:'.ROOTHOST);
}
?>