<?php
if(isLogin()){
$username=getInfo('username');
$obj=SysGetList('tbl_member_wallet',array()," AND username='$username'");
$wallet=isset($obj[0]['wallet'])?$obj[0]['wallet']:'';
$P_Balance=$wallet!=''?getBalance(URL_NODEJS_SERVER,$wallet):0;
$itemBalance=$P_Balance==0?'':number_format($P_Balance);
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel row' style='padding-top:15px;'>
		<div class='box'>
			<div class='header'>
				<div class='text-center'>
					<h3 class='title'>SEND PITNEX</h3>					
				</div>
			</div><hr/>
			<div class='col-sm-12 main' id='send_pit_panel'>
				<div class='text-center mess_error' style='color:red;'></div>
				<div class='form-group'>
					<label>My PITNEX balance</label>
					<input type='text' readonly class='form-control text-center' databalance='<?php echo number_format($P_Balance);?>' id='txt_my_balance' value='<?php echo $itemBalance;?>' placeholder='0.00' /> 
				</div>
				<div class='form-group'>
					<label>Recipient</label>
					<input type='text' class='form-control' id='txt_receive_address' placeholder='Enter a PITNEX address' /> 
				</div>
				<div class='form-group'>
					<label>Amount</label>
					<div class="input-group">
						<input type="text" class="form-control number" placeholder="0.00 PIT" id="txt_pit_amount">
						<div class="input-group-addon">
							<span class="input-group-text"><=></span>
						</div>
						<input type="text" class="form-control number" placeholder="0.00 VNĐ" id="txt_usd_amount">
					</div>
				</div>
				<div class='form-group'>
					<label>Note</label>
					<textarea class='form-control' id='txt_note' placeholder='Send message'> </textarea>
				</div>
				<div class='form-group'>
					<div>Fee <span class='pull-right' id='fee_rate' datafee='0'><span id='fee_pit'>0.00 PIT</span> (<span id='fee_usd'>0.00 VNĐ</span>)</span></div>
					<div>Total <span class='pull-right' datafee='0'><span id='total_pit'>0.00 PIT</span> (<span id='total_usd'>0.00 VNĐ</span>)</span></div>
				</div>
				<div class='form-group'>
					<button type='button' class='btn btn-primary btn-block' id='btn_send_pit'>Continue >></button>
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
				$('#txt_usd_amount').keyup(function(e){
					if($(this).val()!=''){
						var usd_amount=parseFloat($(this).val());
						var pit_amount=usd_amount/23500;
						$('#txt_pit_amount').val(pit_amount.toFixed(2));
					}else{
						$('#txt_pit_amount').val('');
					}
					setFee();
				});
				$('#txt_pit_amount').keyup(function(e){
					if($(this).val()!=''){
						var pit_amount=parseFloat($(this).val());
						var usd_amount=pit_amount*23500;
						$('#txt_usd_amount').val(usd_amount.toFixed(2));
					}else{
						$('#txt_usd_amount').val('');
					}
					setFee();
				})
				$('#btn_send_pit').click(function(){
					$('.mess_error').html("");
					var mybalance=$('#txt_my_balance').attr('databalance');
					if(parseFloat(mybalance)<=0){
						$('.mess_error').html('Your balance is empty or You do not have pitnex wallet address!');
						return;
					}
					if($('#txt_receive_address').val()==''){
						$('.mess_error').html("The recipient's wallet address is empty");
						$('#txt_receive_address').focus();
						return;
					}
					if($('#txt_receive_address').val().length!=12 || $('#txt_receive_address').val().substring(0,1)!='p'){
						$('.mess_error').html("The recipient's wallet address is not in the correct format");
						$('#txt_receive_address').focus();
						return;
					}
					var _url='<?php echo ROOTHOST;?>ajaxs/pit/send2FA.php';
					var _data={
						'receive_address':$('#txt_receive_address').val(),
						'amount':$('#txt_pit_amount').val(),
						'note':$('#txt_note').val()
					}
					$.post(_url,_data,function(req){
						$('#send_pit_panel').html(req);
					});
					
				});
				function setFee(){
					var _fee=$('#fee_rate').attr('datafee');
					var _amount=$('#txt_pit_amount').val();
					var _FeeAmount=0;
					var _TotalAmount=0;
					if(_amount!=''){
						_FeeAmount=parseFloat(_fee)*parseFloat(_amount);
						_TotalAmount=parseFloat(_amount)+_FeeAmount;
						console.log(_FeeAmount);
					}
					$('#fee_pit').html(_FeeAmount.toFixed(2)+' PIT');
					$('#fee_usd').html(_FeeAmount.toFixed(2)+' VNĐ');
					$('#total_pit').html(_TotalAmount.toFixed(2)+' PIT');
					$('#total_usd').html(_TotalAmount.toFixed(2)+' VNĐ');
				}
				</script>
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