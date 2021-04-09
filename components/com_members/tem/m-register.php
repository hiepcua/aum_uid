<?php
if(!isLogin()){
?>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel'>
		<div class='header'>
			<div class='text-center'>
				<h2 class='title'>REGISTER</h2>
			</div>
		</div>
		<div class='main'>
			<div class='frm'>
				<div class="form-group">
					<div class='err_mess cred text-center'></div>
				</div>
				<div class="form-group">
					<label class="control-label">Fullname</label>
					<input type='text' class='form-control' name='txt_name' id='txt_name' placeholder='Fullname' value='' required/>
				</div>
				<div class="form-group">
					<label class="control-label">Username (E-mail)</label>
					<input type='text' class='form-control' name='txt_user' id='txt_user' placeholder='E-mail' value='' required/>
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
					<input type='password' class='form-control' name='txt_pas' id='txt_pas' placeholder='password' value='' required/> 
				</div>
				<div class="form-group">
					<label class="control-label">Confirm password</label>
					<input type='password' class='form-control' name='txt_rpas' id='txt_rpas' placeholder='confirm password' value='' required/> 
				</div>
				<div class="form-group">
					<label class="custom-control-label"><input type="checkbox" class="custom-control-input" id="isConfirm"> I certify that I am 18 years or older and I accept the <a href='#'>User Agreement</a> and <a href='#'>Privacy Policy</a>.</label>
				</div>
				<div class='form-group'>
					<button type='button' id='btn-process-register' class='btn btn-block btn-primary'>REGISTER</button>
				</div>
				<div class='form-group text-center'>
					<a href='<?php echo ROOTHOST;?>login'>Login</a> to your Pitnex account.
				</div>
				<script>
				$('#txt_name').focus();
				$('#btn-process-register').click(function(){
					register();
				});
				function register(){
					if($('#txt_name').val()==''){
						$('.err_mess').html('Fullname is required!');
						return;
					}
					if($('#txt_user').val()=='' || $('#txt_pas').val()=='' ){
						$('.err_mess').html('Username and Password are required!');
						return;
					}
					if( $('#txt_pas').val()!= $('#txt_rpas').val()){
						$('.err_mess').html('Confirm password not match with password!');
						return;
					}
					var _ischeck=$('#isConfirm').is(':checked')?'yes':'no';
					if(_ischeck=='no'){
						$('.err_mess').html('You must accept our User Agreement and Privacy Policy.!');
						return;
					}
					$('.err_mess').html('');
					
					var _url='<?php echo ROOTHOST;?>ajaxs/mem/process_register.php';
					var _data={
						'fullname':$('#txt_name').val(),
						'username':$('#txt_user').val(),
						'password':$('#txt_pas').val()
					}
					$('#btn-process-register').hide();
					$.post(_url,_data,function(req){
						if(req=='success')  window.location.href="<?php echo ROOTHOST;?>r-success";
						else{ $('.err_mess').html(req);
							$('#btn-process-register').show();
						}
					});
				}
				</script>
			</div>
		</div>
	</div>
</div>
<div class='col-sm-4'></div>
<script></script>
<?php	
}else{
	header('location:'.ROOTHOST);
}
?>