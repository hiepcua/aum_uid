<?php
if(isLogin()){
	$username=getInfo('username');
	$res_phongban = file_get_contents(JSON_HOST."group.json");
	echo $res_phongban;
	?>
	<div class="col-md-12">
		<div class='page-title'>Quản lý phòng ban</div>
		<div class="page-body">
			<div class="form-group">
				<form id="frm_search" name="frm_search" method="get" action="">
					<div class="col-md-4"><div class="row">
						<input type="hidden" class="form-control" name="com" id="com" value="city">
						<input type="hidden" class="form-control" name="task" id="task" value="">
						<input type="text" class="form-control" name="q" id="txt_q" placeholder="Tên tỉnh thành" value="<?php echo $key;?>">
					</div></div>
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary" name="filterDebt" id="btn_add"><i class="fa fa-dollar"></i> Thêm mới</button>
					</div>
				</form>
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