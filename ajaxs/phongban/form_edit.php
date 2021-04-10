<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.mysql1.php');

$postID = isset($_POST['code']) ? antiData($_POST["code"]) : '';
$res_phongban = SysGetList('tbl_bustype', array(), " AND code='".$postID."'");
if(count($res_phongban) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_phongban[0];
?>
<br/>
<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Mã phòng ban </label><font color="red">(*)</font>
				<input type="text" id="txt_code" name="txt_code" class="form-control required" value="<?php echo $row['code'];?>" placeholder="Mã phòng ban">
			</div>
			<div class="form-group">
				<label>Tên phòng ban </label><font color="red">(*)</font>
				<input type="text" id="txt_name" name="txt_name" class="form-control required" value="<?php echo $row['name'];?>" placeholder="Tên phòng ban">
			</div>
		</div>
	</div>

	<div class="text-center toolbar">
		<input type="submit" name="cmdsave_tab" id="cmdsave_tab" class="save btn btn-success" value="Lưu" class="btn btn-primary">
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("form#frm_action").submit(function(e) {
			if(validForm()){
				e.preventDefault();
				var formData = new FormData(this);

				var _url="<?php echo ROOTHOST;?>ajaxs/phongban/process_add.php";
				$.ajax({
					url: _url,
					type: 'POST',
					data: formData,
					success: function (res) {
						if(parseInt(res) == 1){
							showMess("Cập nhật thành công");
							setTimeout(function(){window.location.reload(); }, 2000);
						}else if(parseInt(res)==3){
							alert('Bạn không có quyền thực hiện chức năng này!');
						}else{
							alert('Lỗi!');
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}else{
				e.preventDefault();
			}
		});
	});

	function validForm(){
		var flag = true;
		$('#myModalPopup .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parents('.form-group').addClass('error');
				flag = false;
			}

			if(flag==false) {
				$('.ajx_mess').html('Những mục có đánh dấu * là những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>