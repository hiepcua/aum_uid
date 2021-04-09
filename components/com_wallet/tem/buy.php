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
				<div>Pay for get pitnex</div>
				<div class='form-group'>
					<select class='form-control' id='cbo_wallet_list' >
					<?php 
					global $_WALLET_LIST; $arr=array();
					foreach($_WALLET_LIST as $key=>$val){
						if(count($arr)==0) $arr=$val;
					?>
						<option value='<?php echo $val['address'];?>'><?php echo $val['name'];?></option>
					<?php }?>
					</select>
					<div class='text-center'>
						<img id='wallet_qr' src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=<?php echo $arr['address'];?>&choe=UTF-8'/>
						<div id='wallet_address'><?php echo $arr['address'];?></div>
					</div>
					<script>
					$('#cbo_wallet_list').change(function(){
						_address=$(this).val();
						_url="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl="+_address+"&choe=UTF-8"
						$('#wallet_qr').attr('src',_url);
						$('#wallet_address').html(_address);
					});
					</script>
				</div>
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