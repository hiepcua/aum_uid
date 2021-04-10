<?php
if(isLogin()){
	$username=getInfo('username');
	$get_name=$strWhere='';
	$start=$MAX_ROWS=0;
	$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';

	if($get_q!==''){
		$strWhere.= " AND `name` LIKE '%".$get_q."%'";
	}

	/* ---------------------------------------- */
	$MAX_ROWS = 2;
	$total_rows = 3;
	// $total_rows = SysCount('tbl_group', $strWhere);
	$max_pages = ceil($total_rows/$MAX_ROWS);
	$cur_page = getCurentPage($max_pages);
	$start = ($cur_page - 1) * $MAX_ROWS;
	$limit = ' LIMIT '.$start.','. $MAX_ROWS;
	$strWhere.= $limit;
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
						<button type="button" class="btn btn-primary" name="filterDebt" onclick="addNew()"><i class="fa fa-dollar"></i> Thêm mới</button>
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
<script type="text/javascript">
	$(document).ready(function(){
		getTable("<?php echo $strWhere;?>", "<?php echo $start;?>", "<?php echo $MAX_ROWS;?>");
		update();

		$('#btn_add').on('click', function(){
			addNew();
		})
	});

	function getTable(strwhere, start, max_rows){
		var _url="<?php echo ROOTHOST;?>ajaxs/phongban/get_table.php";
		var _data={
			"strwhere": strwhere,
			"start": start,
			"max_rows": max_rows,
		};

		$.get(_url, _data, function(req){
			$('#data-table').html(req);
		});
	}

	function addNew(){
		var _url="<?php echo ROOTHOST;?>ajaxs/phongban/form_add.php";
		$.get(_url, function(req){
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Thêm phòng ban');
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	}

	function update(){
		// var code = e.getAttribute('data-code');
		var code = 'vccu-3';
		var _url="<?php echo ROOTHOST;?>ajaxs/phongban/form_edit.php";
		$.post(_url, {"code": code}, function(req){
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật phòng ban');
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	}
</script>