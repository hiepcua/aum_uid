<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.postgre.php');
if(isLogin()){
$username=getInfo('username');
$type=isset($_POST['type'])?$_POST['type']:'no';
$obj=SysGetList('tbl_invest_group',array(),"AND username='$username' ORDER BY id",false);
$arrGroup=array();
while($r=$obj->Fetch_Assoc()){
	$arrGroup['G'.$r['id']]=$r;
}

?>
<h2 class='text-center'>Create Investment</h2>
<div class="row form-group">
	<label class="col-sm-12"><strong>Investment Group:</strong></label>
	<div class="col-sm-6">
		<select id="cbo_group" name="cbo_group" size="1" class="form-control">
		<?php foreach($arrGroup as $key=>$item){?>
		<option value="<?php echo $key;?>"><?php echo $item['name'];?></option>
		<?php }?>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-sm-6"><div class='row'>
		<label class="col-sm-12"><strong>Coin A:</strong> (Coin base)</label>
		<div class="col-sm-6">
			<input type="text" list="data_coin" class="form-control" name="coin_a" id="coin_a" value="" required autocomplete="off" placeholder="Coin base"/>
			<datalist id="data_coin">
				<?php foreach($_MARKET as $item){?>
				<option value="<?php echo $item;?>"><?php echo $item;?></option>
				<?php }?>
			</datalist>
		</div>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="quan_a" id="quan_a" value="" required autocomplete="off" placeholder="Quantity"/>
		</div>
	</div></div>
	<div class="col-sm-6"><div class='row'>
		<label class="col-sm-12"><strong>Coin B:</strong> (Alcoin)</label>
		<div class="col-sm-6">
			<input type="text" list="data_coin" class="form-control" name="coin_b" id="coin_b" value="" required autocomplete="off" placeholder="Alcoin"/>
			<datalist id="data_coin">
				<?php foreach($_MARKET as $item){?>
				<option value="<?php echo $item;?>"><?php echo $item;?></option>
				<?php }?>
			</datalist>
		</div>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="quan_b" id="quan_b" value="" required autocomplete="off" placeholder="Quantity"/>
		</div>
	</div></div>
	<div class='clearfix'></div>
</div><hr/>
<div class="row form-group">
	<div class="col-sm-6">
		<label><strong>Min price:</strong> (Price start investment)</label>
		<input type="number" class="form-control" name="txt_minprice" id="txt_minprice" value="" required/>
	</div>
</div>
<div class="row form-group">
	<div class="col-sm-4">
		<label><strong>Rate sell:</strong></label>
		<input type="number" class="form-control" name="txt_rate_sell" id="txt_rate_sell" value="5" required/>
		<label>Rate of Unit growth will sell</label>
	</div>
	<div class="col-sm-4">
		<label><strong>Rate buy:</strong></label>
		<input type="number" class="form-control" name="txt_rate_buy" id="txt_rate_buy" value="5" required/>
		<label>Rate of unit reduction will buy</label>
	</div>
	<div class="col-sm-4">
		<label><strong>Rate more:</strong></label>
		<input type="number" class="form-control" name="txt_rate_more" id="txt_rate_more" value="1" required/>
		<label>Rate plus per increase / decrease</label>
	</div>
</div>
<div class="row form-group clearfix text-center">
	<button type="button" class="btn btn-primary" id="cmd_process_addinvest"> Save </button>
	<button type="reset" class="btn btn-default"> Cancel </button>
</div>
<script>
$('#cmd_process_addinvest').click(function(){
	var _url="<?php echo ROOTHOST;?>ajaxs/invest/add_process.php";
	var _data={
		'group':$('#cbo_group').val(),
		'coina':$('#coin_a').val(),
		'coinb':$('#coin_b').val(),
		'quana':$('#quan_a').val(),
		'quanb':$('#quan_b').val(),
		'minprice':$('#txt_minprice').val(),
		'ratesell':$('#txt_rate_sell').val(),
		'ratebuy':$('#txt_rate_buy').val(),
		'ratemore':$('#txt_rate_more').val()
	}
	$.post(_url,_data,function(req){
		console.log(req);
		if(req=='success'){
			window.location.reload();
		}else{
			alert(req)
		}
	});
});

</script>
<?php } die();?>