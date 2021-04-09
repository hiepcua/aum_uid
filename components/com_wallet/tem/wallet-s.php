<?php
global $_UNIT;
if(isLogin()){
$username=getInfo('username');
$obj=SysGetList('tbl_member_wallet',array()," AND username='$username'");
$wallet=isset($obj[0]['wallet'])?$obj[0]['wallet']:'';
$S_Balance=getWalletBalance('tbl_wallet_s',$username);
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
	<div class='wallet_panel row' style='padding-top:15px;'>
		<div class='col-xs-12 text-center'>
			<div class='card wallet primary' data_mod='p-wallet'>
				<div><strong>STAKE WALLET</strong></div>
				<div>Your balance</div>
				<h2 class='money'><?php echo number_format($S_Balance,2);?><span class='unit_currency'>S.PIT</span></h2>
				<div class='withdraw'>
					<button type='button' id='btn_withdraw_topit' class='btn btn-default'>WITHDRAW TO PITNEX</button>
				</div>
				<script>
				$('#btn_withdraw_topit').click(function(){
					var _url='<?php echo ROOTHOST;?>ajaxs/pit/Withdraw.php?w=s';
					$.get(_url,function(req){
						$('#myModal .modal-body').html(req);
						$('#myModal').modal('show');
					});
				});
				</script>
			</div>
		</div>
		<div class='clearfix'></div>
	</div>
	<div class='member-panel form-group'>
		<h3 class='title'><i class="fa fa-users"></i> My Histories</h3>
		<div class='table-responsive box'>
			<table class="table table-hover">
				<thead><tr>
					<th>DATE</th>
					<th>S.PIT</th>
					<th>NOTE</th>
				</tr></thead>
				<tbody>
				<?php 
				$n=SysCount('tbl_wallet_s'," AND username='$username'");
				if($n>0){
				$obj=SysGetList('tbl_wallet_s',array()," AND username='$username' ORDER BY cdate DESC LIMIT 100",false);
				while($r = $obj->Fetch_Assoc()) {
					$cdate=date('Y-m-d H:i',$r['cdate']);
					?>
					<tr>
						<td><?php echo $cdate;?></td>
						<td><?php echo number_format($r['money'],2);?> PIT</td>
						<td><?php echo $r['note'];?></td>
					</tr>
				<?php } 
				}else{
				?>
					<tr>
						<td colspan='4' class='text-center'>There is no history</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id='site-footer'><?php //require_once('modules/site-footer.php');?></div>
<?php }else{
	header('location:'.ROOTHOST.'login');
}?>