<?php
if(isLogin()){
$username=getInfo('username');
$check_kyc=(int)getInfo('iskyc')==1?"yes":"no";
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel row' style='padding-top:15px;'>
		<div class='box'>
			<div class='header'>
				<div class='text-center'>
					<h3 class='title'>RECEIVE PITNEX</h3>					
				</div>
			</div><hr/>
			<div class='main'>
				<div class='form-group wallet_qrcode text-center' id='wallet_qrcode'>
				<?php
				$flag=true;
				if($check_kyc=='yes'){
					$obj=SysGetList('tbl_member_wallet',array()," AND username='$username'");
					$wallet=isset($obj[0]['wallet'])?$obj[0]['wallet']:'';
					if($wallet!==''){
						$url="https://chart.googleapis.com/chart?cht=qr&choe=UTF-8&chs=300x300&chl=$wallet";
						?>
						<h4 id='pit_wallet'><?php echo $wallet;?></h4>
						<div class="text-center"><img src="<?php echo $url;?>" /></div>
						<button type="button" class="btn btn-success" data_account="<?php echo $wallet;?>" id="btn_copy_wallet" >Copy wallet</button>
						<script>
						$('#btn_copy_wallet').click(function(){
							var $temp = $("<input>");
							$("body").append($temp);
							$temp.val($(this).attr('data_account')).select();
							document.execCommand("copy");
							$temp.remove();
						});
						</script>
						<?php
					}else{
						$flag=false;
						echo "<span class='red'>No wallet address yet.</span>";
					}
				}else{
					$flag=false;
					echo "<span class='red'>You have not kyc. Let kyc now!</span>";
				}
				?>	
				</div>
				<div class='clearfix'></div>
			</div>
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