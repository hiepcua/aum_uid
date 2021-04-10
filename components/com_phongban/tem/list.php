<?php
if(isLogin()){
	$username=getInfo('username');
	$res_phongban = file_get_contents(JSON_HOST."group.php");
	var_dump($res_phongban);

	$get_name='';
	$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';

	if($get_q!==''){

	}
	?>
	<div class="col-md-12">
		<h3 class='page-title'>Quản lý phòng ban</h3>
		<div class="page-body">
			<div class="row">
				<div class="form-group col-md-12">
					<form id="frm_search" name="frm_search" method="get" action="">
						<div class="col-md-4"><div class="row">
							<input type="text" class="form-control" name="q" id="txt_q" placeholder="Tên phòng ban" value="<?php echo $get_q;?>">
						</div></div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
						</div>
					</form>
					<div class="pull-right">
						<button type="button" class="btn btn-primary" name="filterDebt" id="btn_add"><i class="fa fa-dollar"></i> Thêm mới</button>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Handle</th>
						</tr>
					</thead>
					<tbody id="data-table"></tbody>
				</table>
			</div>
		</div>
	</div>
	<?php	
}else{
	header('location:'.ROOTHOST);
}
?>