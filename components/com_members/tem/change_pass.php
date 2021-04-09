<?php
if(isLogin()){
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel row' style='padding-top:15px;'>
		<div class='box'>
			<div class='header'>
				<div class='text-center'>
					<h2 class='title'>CHANGE PASSWORD</h2>
				</div>
			</div>
			<div class='main'>
				<div class='col-sm-12'>
				<div id="messageError" class="mess text-center" style="color:red;"></div>
				<div id="messageSuccess" class="mess text-center" style="color:green;"></div>
				<form name="frm_update_member" id="frm_update_member" action=""  method="POST" class="form_add">
					<div class="form-group">
						<div class="txt"><i class="fa fa-key"></i> Old Password</div>
						<input type="password"  class="form-control" id="txtpass" name="txtpass" value="" required>
					</div>
					<div class="form-group">
						<div class="txt"><i class="fa fa-key"></i> New Password</div>
						<input type="password" class="form-control" name="txt_newpass" id="txt_newpass" value="" required minlength="6">
					</div>
					<div class="form-group">
						<div class="txt"><i class="fa fa-key"></i> Confirm Password</div>
						<input type="password" class="form-control" name="txt_newpass2" id="txt_newpass2" value="" required minlength="6">
					</div>
					<div class="form-group text-center"><button type="button" class="btn btn-primary" id="btn_process_changepass">Change password >></button></div>
					<br>
				</form>
				</div>
				<div class='clearfix'></div>
				<script>
				$('#txtpass').focus();
				$('#btn_process_changepass').click(function(){
					changepass();
				})
				$('#txt_newpass,#txt_newpass2').keyup(function(e){
					 var code = (e.keyCode ? e.keyCode : e.which);
					if (code==13) {
						e.preventDefault();
						changepass();
					}
				})
				function changepass(){
					if(!checkfrm()) return;
					var _url='<?php echo ROOTHOST;?>ajaxs/mem/process_changepass.php';
					var _data={
						'oldpass':$('#txtpass').val(),
						'password':$('#txt_newpass').val()
					}
					$('#messageError').html('');
					$.post(_url,_data,function(req){
						console.log(req);
						if(req=='success'){
							$('#messageSuccess').html('Change password successful!');
						}else $('#messageError').html(req);
					});
				}
				function checkfrm() {
					if($('#txtpass').val()=='') {
						$('#messageError').html('Password is required!');
						$('#txtpass').focus();
						return false;
					}
					if($('#txt_newpass').val().length<6) {
						$('#messageError').html('Password must be at least 6 characters');
						$('#txt_newpass').focus();
						return false;
					}
					if($('#txt_newpass').val()!=$('#txt_newpass2').val()) {
						$('#messageError').html('Password confirmation does not match');
						$('#txt_newpass2').focus();
						return false;
					}
					return true;
				}
				</script>
			</div>
		</div>
	</div>
</div>
<div class='col-sm-4'></div>
</div>
<div id='site-footer'><?php //require_once('modules/site-footer.php');?></div>
<?php }else{
	header('location:'.ROOTHOST.'login');
}?>