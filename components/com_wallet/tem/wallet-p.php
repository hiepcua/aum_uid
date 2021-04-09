<?php
global $_UNIT;
if(isLogin()){
$username=getInfo('username');
$obj=SysGetList('tbl_member_wallet',array()," AND username='$username'");
$wallet=isset($obj[0]['wallet'])?$obj[0]['wallet']:'';
$P_Balance=$wallet!=''?getBalance(URL_NODEJS_SERVER,$wallet):0;
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
	<div class='wallet_panel row' style='padding-top:15px;'>
		<div class='col-xs-12 text-center'>
			<div class='card wallet success' data_mod='p-wallet'>
				<div><strong>PITNEX WALLET</strong></div>
				<div>Your balance</div>
				<h2 class='money'><?php echo number_format($P_Balance,2);?><span class='unit_currency'>PIT</span></h2>
			</div>
			
		</div>
		<div class='clearfix'></div>
	</div>
	<div class='module_panel row'>
		<div class='col-sm-3 col-xs-6 text-center'>
			<div class='card' data_mod='send'>
				<div class='ico'><i class="fa fa-upload"></i></div>
				<div>Send PIT</div>
			</div>
		</div>
		<div class='col-sm-3 col-xs-6 text-center'>
			<div class='card' data_mod='receive'>
				<div class='ico'><i class="fa fa-download"></i></div>
				<div>Receive PIT</div>
			</div>
		</div>
		<div class='col-sm-3 col-xs-6 text-center'>
			<div class='card' data_mod='buy'>
				<div class='ico'><i class="fa fa-credit-card"></i></div>
				<div>Buy Pit</div>
			</div>
		</div>
		<div class='col-sm-3 col-xs-6 text-center'>
			<div class='card' data_mod='payment'>
				<div class='ico'><i class="fa fa-qrcode"></i></div>
				<div>Payment</div>
			</div>
		</div>
		<div class='clearfix'></div>
	</div>
	<script>
	$('.card').click(function(){
		var _mod=$(this).attr('data_mod');
		window.location.href='<?php echo ROOTHOST;?>'+_mod;
	});
	</script>
	<div class='member-panel form-group'>
		<h3 class='title'><i class="fa fa-users"></i> My Histories</h3>
		<div class='table-responsive box'>
			<table class="table table-hover">
				<thead><tr>
					<th>DATE</th>
					<th>FROM</th>
					<th>TO</th>
					<th>AMOUNT</th>
					<th>TYPE</th>
					<th>NOTE</th>
				</tr></thead>
				<tbody>
				<?php 
				$obj=new CLS_MYSQL;
				$sql="SELECT * FROM tbl_transaction WHERE username='$username' ORDER BY cdate DESC LIMIT 0,100";
				$obj->Query($sql);
				if($obj->Num_rows()>0){
				while($r = $obj->Fetch_Assoc()) {
				$cdate=date('Y-m-d H:i',$r['cdate']);
				?>
				<tr>
					<td><a href='https://bloks.io/transaction/<?php echo $r['txhash'];?>' target='_blank'><?php echo $cdate;?></a></td>
					<td><?php echo $r['from_wallet'];?></td>
					<td><?php echo $r['to_wallet'];?></td>
					<td><?php echo number_format($r['amount'],2);?> PIT</td>
					<td><span class='bggreen'><?php echo $r['type'];?></span></td>
					<td><?php echo $r['memo'];?></td>
				</tr>
				<?php } 
				}else{
				?>
				<tr>
					<td colspan='4' class='text-center'>Không có lịch sử nào</td>
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