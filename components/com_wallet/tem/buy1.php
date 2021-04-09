<?php
if(isLogin()){
$username=getInfo('username');
$obj=SysGetList('tbl_member_wallet',array()," AND username='$username'");
$wallet=isset($obj[0]['wallet'])?$obj[0]['wallet']:'';
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel row' style='padding-top:15px;'>
		<div class='box'>
			<div class='header'>
				<div class='text-center'>
					<h3 class='title'>BUY PITNEX</h3>					
				</div>
			</div><hr/>
			<div class='col-sm-12 main' id='send_pit_panel'>
			<?php if($wallet!=''){?>
				<div class='text-center mess_error' style='color:red;'></div>
				<div class='form-group'>
					<label>Amount</label>
					<div class="input-group">
						<input type="text" class="form-control number" placeholder="0.00 PIT" id="txt_pit_amount">
						<div class="input-group-addon">
							<span class="input-group-text">PIT</span>
						</div>
					</div>
				</div>
				<div class='form-group'>
					<label>2FA Code</label>
					<input type='text' class='form-control text-center' id='txt_2fa' placeholder='Google authenticator code' required /> 
				</div>
				<div class='form-group'>
					<button type='button' class='btn btn-primary btn-block' id='btn_buy_pit'>Continue >></button>
				</div>
				<div class='clearfix'></div>
				<script>
				$('.number').keydown(function(e){
					if((e.which>=48 && e.which<=57 ) || e.which==190 || e.keyCode == 46 || e.keyCode == 8 || e.keyCode == 39 || e.keyCode == 37){
						var _val=$(this).val();
						if(e.which==190) {
							if(_val==''){
								$(this).val('0.'); return;
							}else{
								var n = _val.indexOf(".");
								if(n>=0) return false;
							}
						}
						return true;
					}
					return false;
				})
				$('#btn_buy_pit').click(function(){
					$('.mess_error').html("");
					if($('#txt_pit_amount').val()=='' || parseInt($('#txt_pit_amount').val())=='NaN	' || parseInt($('#txt_pit_amount').val())<100){
						$('.mess_error').html("Amount is number and larger 100");
						$('#txt_pit_amount').focus();
						return;
					}
					if($('#txt_2fa').val().length!=6 || $('#txt_2fa').val()==''){
						$('.mess_error').html("2Fa code is 6 characters");
						$('#txt_2fa').focus();
						return;
					}
					var _url='<?php echo ROOTHOST;?>ajaxs/pit/buypit.php';
					var _data={
						'code_2fa':$('#txt_2fa').val(),
						'amount':$('#txt_pit_amount').val()
					}
					$.post(_url,_data,function(req){
						$('#send_pit_panel').html(req);
					});
					
				});
				</script>
			<?php }else{
				echo "<div class='text-center'>Bạn chưa có địa chỉ ví, hãy kích hoạt ví pitnex trước khi có thể mua pit!</div>";
			}?>
			</div>
			<div class='clearfix'></div>
		</div>
	</div>
</div>
<div class='col-sm-4'></div>
</div>
<?php	
}else{
	header('location:'.ROOTHOST);
}
?>