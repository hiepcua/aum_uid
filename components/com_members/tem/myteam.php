<?php
if(isLogin()){
$username=getInfo('username');
global $_PACKET;
$arr1=array();
$arr2=array();
?>
<div id='site-header'><?php require_once('modules/site-header.php');?></div>
<div class='container'>
	<div class="setting-panel" style='padding-top:15px;'>
		<div class='box' style='padding:15px;'>
		<h3 class='text-center'>MY TEAMS</h3>
		<hr/>
		<?php 
		$leftcode=encrypt($username.'|0');
		$rightcode=encrypt($username.'|1');
		$dsA=getDSNhom($username,0);
		$dsB=getDSNhom($username,1);
		?>
		<div class='affiliate row'>
			<div class='col-sm-6'><div class='form-group'>
				<strong class=''>Affiliate left: (<?php echo number_format($dsA);?> PIT)</strong>
				<div class='input-group'>
					<input type='text' class='form-control' id='affiliate1' value='<?php echo ROOTHOST;?>register?req=<?php echo urlencode($leftcode);?>' />
					<div class='input-group-addon primary'><span class='affiliate_copy' data='1'>Copy link</span></div>
				</div>
			</div></div>
			<div class='col-sm-6'><div class='form-group'>
				<strong class=''>Affiliate right: (<?php echo number_format($dsB);?> PIT)</strong>
				<div class='input-group'>
					<input type='text' class='form-control' id='affiliate2' value='<?php echo ROOTHOST;?>register?req=<?php echo urlencode($rightcode);?>' />
					<div class='input-group-addon primary'><span class='affiliate_copy' data='2'>Copy link</span></div>
				</div>
			</div></div>
			<script>
			$('.affiliate_copy').click(function(){
				var _val=$(this).attr('data');
				var copytext=document.getElementById("affiliate"+_val);
				copytext.select()
				copytext.setSelectionRange(0,99999);
				document.execCommand("copy");
			});
			</script>
			<div class='clearfix'></div>
		</div>
		</div>
		<div class='member-panel form-group'>
			<h3 class='title'><i class="fa fa-users"></i> Tier 1 agents</h3>
			<div class='table-responsive box'>
				<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 20%;"><strong>DATE</strong></th>
						<th	style="width: 20%;"><strong>Fullname</strong></th>
						<th class="text-center" style="width: 20%;"><strong>ID</strong></th>
						<th class="text-center" style="width: 20%;"><strong>PACKET</strong></th>
						<th class="text-center" style="width: 20%;"><strong>LEVEL</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$obj=SysGetList('tbl_member',array()," AND par_user='$username'",false);
					while($r_mem=$obj->Fetch_Assoc()){
						$arr1[]=$r_mem['username'];
						$jdate=date('Y-m-d H:i',$r_mem['cdate']);
						$packet=isset($_PACKET['P'.$r_mem['packet']]['name'])?$_PACKET['P'.$r_mem['packet']]['name']:'';
					?>
					<tr>
						<td style="width: 20%;"><?php echo $jdate;?></td>
						<td style="width: 20%;"><?php echo $r_mem['fullname'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['username'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['packet'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $packet;?></td>
					</tr>
					<?php }?>
				</tbody>
				</table>
			</div>
		</div>
		<div class='member-panel form-group'>
			<h3 class='title'><i class="fa fa-users"></i> Tier 2 agents</h3>
			<div class='table-responsive box'>
				<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 20%;"><strong>DATE</strong></th>
						<th	style="width: 20%;"><strong>Fullname</strong></th>
						<th class="text-center" style="width: 20%;"><strong>ID</strong></th>
						<th class="text-center" style="width: 20%;"><strong>PACKET</strong></th>
						<th class="text-center" style="width: 20%;"><strong>LEVEL</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$str_user=implode("','",$arr1);
					$obj=SysGetList('tbl_member',array()," AND par_user IN ('$str_user')",false);
					if($obj->Num_rows()>0){
					while($r_mem=$obj->Fetch_Assoc()){
						$arr2[]=$r_mem['username'];
						$jdate=date('Y-m-d H:i',$r_mem['cdate']);
						$packet=isset($_PACKET['P'.$r_mem['packet']]['name'])?$_PACKET['P'.$r_mem['packet']]['name']:'';
					?>
					<tr>
						<td style="width: 20%;"><?php echo $jdate;?></td>
						<td style="width: 20%;"><?php echo $r_mem['fullname'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['username'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['packet'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $packet;?></td>
					</tr>
					<?php }
					}else{
					?>	
					<tr>
						<td colspan='5' class='text-center'>There is no agent</td>
					</tr>
					<?php }?>
				</tbody>
				</table>
			</div>
		</div>
		<div class='member-panel form-group'>
			<h3 class='title'><i class="fa fa-users"></i> Tier 3 agents</h3>
			<div class='table-responsive box'>
				<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 20%;"><strong>DATE</strong></th>
						<th	style="width: 20%;"><strong>Fullname</strong></th>
						<th class="text-center" style="width: 20%;"><strong>ID</strong></th>
						<th class="text-center" style="width: 20%;"><strong>PACKET</strong></th>
						<th class="text-center" style="width: 20%;"><strong>LEVEL</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$str_user=implode("','",$arr2);
					$obj=SysGetList('tbl_member',array()," AND par_user IN ('$str_user')",false);
					if($obj->Num_rows()>0){
					while($r_mem=$obj->Fetch_Assoc()){
						$jdate=date('Y-m-d H:i',$r_mem['cdate']);
						$packet=isset($_PACKET['P'.$r_mem['packet']]['name'])?$_PACKET['P'.$r_mem['packet']]['name']:'';
					?>
					<tr>
						<td style="width: 20%;"><?php echo $jdate;?></td>
						<td style="width: 20%;"><?php echo $r_mem['fullname'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['username'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $r_mem['packet'];?></td>
						<td class="text-center" style="width: 20%;"><?php echo $packet;?></td>
					</tr>
					<?php }
					}else{
					?>	
					<tr>
						<td colspan='5' class='text-center'>There is no agent</td>
					</tr>
					<?php }?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id='site-footer'><?php //require_once('modules/site-footer.php');?></div>	
<?php
}else{
	header('location:'.ROOTHOST.'login');
}
?>