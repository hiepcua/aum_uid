<?php
if(isLogin()){
$username=getInfo('username');
$isBus=getInfo('isbus');
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
					<h3 class='title'>PAYMENT</h3>					
				</div>
			</div><hr/>
			<div class='col-sm-12 main' id='send_pit_panel'>
				<div class="body">
					<div class='text-center'>
						<?php if($isBus==1){ ?>
						<div><strong>Accepted Here</strong></div>
						<?php
						$arr=array();
						$arr['wallet']=$wallet;
						$arr['callback']='';
						$arr['time']=time();
						$data=encrypt(json_encode($arr,JSON_UNESCAPED_UNICODE)).'|'.$wallet;
						?>
						<img src='https://chart.googleapis.com/chart?cht=qr&choe=UTF-8&chs=300x300&chl=<?php echo $data;?>'/>
						<div class='form-group'><strong>Pay with QR CODE</strong></div>
						<?php }else{?>
						<div class='form-group'>You are not a business<br/>Contact administrator to pay with QR CODE</div>
						<?php } ?>
					</div>
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