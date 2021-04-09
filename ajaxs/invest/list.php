<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_binance.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
if(isLogin()){
$username=getInfo('username');
$AllMarkets=getAllMarket();
$_curPrice=array();
foreach($AllMarkets as $item){
	$_curPrice[$item['symbol']]=$item['price'];
}
?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables dataTable">
<thead>
	<tr role="row">
		<th width="30"></th>
		<th><strong>Investment</strong></th>
		<th><strong>Now quantity</strong></th>
		<th class="text-center"><strong>Unit</strong></th>
		<th><strong>Price</strong></th>
		<th><strong>Rate</strong></th>
		<th class="text-center"><strong>Group name</strong></th>
		<th class="text-center"><strong>cDate</strong></th>
		<th class="text-center"><strong>Status</strong></th>
		<th width="10"></th>
		<th width="10"></th>
	</tr>
</thead>
<tbody>
<?php
$obj=SysGetList('tbl_invest_group',array(),"AND username='$username' ORDER BY id",false);
$arrGroup=array();
while($r=$obj->Fetch_Assoc()){
	$arrGroup['G'.$r['id']]=$r;
}
//---------------------------------------------------------------------------------
$obj=SysGetList('tbl_invests',array(),"AND username='$username' ORDER BY coina",false);
while($r=$obj->Fetch_Assoc()){
$id=$r['id'];
$market=$r['coina'].'-'.$r['coinb'];
$symboll=$r['coinb'].$r['coina'];
$minPrice=$r['min_price'];
$curPrice=$_curPrice[$symboll];
$rateBuy=$r['rate_buy'];
$rateSell=$r['rate_sell'];
$unit=$r['unit']; $quana=floatval($r['quana']);	$quanb=floatval($r['quanb']);
$estQuanb=$quanb*$_curPrice[$symboll];
$uprate=100*($estQuanb-$unit)/$unit;
$cdate=date('Y-m-d H:i',$r['cdate']);
$status=$r['isactive']=='yes'?'run':'stop';
?>
<tr>
	<td><i class="fa fa-trash cgray" aria-hidden="true" dataid="<?php echo $id;?>" onclick="invest_dell(this);"></i></td>
	<td>
		<div><a href=''>ID:#<?php echo $id;?></a></div>
		<div><strong><?php echo $market;?></strong></div>
	</td>
	<td>
	<div><?php echo $r['coina'];?>: <strong class='pull-right'><?php echo number_format(floatval($quana));?></strong> </div>
	<div><?php echo $r['coinb'];?>: <strong class='pull-right'><?php echo number_format(floatval($quanb));?></strong></div>
	</td>
	<td class="text-center">
		<div><?php echo number_format(floatval($unit));?></div>
		<div>up <strong><?php echo floatval($uprate);?></strong> %</div>
	</td>
	<td>
	<div>Min Price: <span class='pull-right'><strong><?php echo number_format(floatval($minPrice));?></strong> <?php echo $r['coina'];?></span></div>
	<div>Cur Price: <span class='pull-right'><strong><?php echo number_format(floatval($curPrice));?></strong> <?php echo $r['coina'];?></span></div>
	</td>
	<td>
	<div>Rate Sell: <span class='pull-right'><i class="fa fa-long-arrow-up"></i><strong><?php echo floatval($rateSell);?></strong>%</span></div>
	<div>Rate Buy: <span class='pull-right'><i class="fa fa-long-arrow-down"></i><strong><?php echo floatval($rateBuy);?></strong>%</span></div>
	</td>
	<td class="text-center"><?php echo $arrGroup['G'.$r['id_group']]['name'];?></td>
	<td class="text-center"><?php echo $cdate;?></td>
	<td class="text-center"><?php echo $status;?></td>
	<td>
		<div><i class="fa fa-edit" dataid="<?php echo $id;?>" onclick="edit_invest(this);"></i></div>
		<div><i class="fa fa-check cgreen" dataid="<?php echo $id;?>" onclick="invest_active(this);"></i></div>
	</td>
	<td><button type='button' class='btn btn-warning' id='btn-clone-invest'><i class="fa fa-files-o"></i> Clone</button></td>
</tr>
<?php }?>
</tbody>
</table>
<?php } die();?>