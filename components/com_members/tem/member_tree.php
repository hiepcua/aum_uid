<ul class="breadcrumb">
	<li><i class="fa fa-home"></i> <a href="<?php echo ROOTHOST;?>">Home</a></li>
	<li class="active">My Netwrork</li>
</ul>
<div class='container-fluid'><div class='row'>
<?php
$objmem=new CLS_MEMBER;
if($objmem->isLogin()==false){?>
<script>window.location='<?php echo ROOTHOST;?>login';</script>
<?php
}
$objmem=new CLS_MEMBER;
$user=$objmem->getMemberUsername();
include_once('includes/gfconfig.php');
include_once('includes/gfinnit.php');
include_once('libs/cls.mysql.php');
include_once('libs/cls.saler.php');

$code=$sub_code = '';
if(isset($_GET['txt_code'])){
	$tg_code=explode('-',addslashes($_GET['txt_code']));
	@$code=$tg_code[1];
}

if(isset($_GET['sub_code']))
	$sub_code=addslashes($_GET['sub_code']);
else
	$sub_code=$code;
// -----------------------------------
?>

<style>
* {margin: 0; padding: 0;}
body{margin:0px; padding:0px;font-family:arial;font-size:13px;}
h1.title{line-height:61px;text-transform:uppercase; border-bottom:#ccc 1px solid;}
a{color:#111;text-decoration:none;}
#hr-treeview ul{margin:0px;padding-top: 20px; text-align:center;position:relative;-webkit-transition: all 0.5s;-moz-transition: all 0.5s;}
#hr-treeview li{
	display: inline-block;
	white-space: nowrap;
	vertical-align: top;
	margin: 0 -2px 0 -2px;
	text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}
#hr-treeview li::after,#hr-treeview li::before{
    content: '';position: absolute;top: 0;right: 50%;border-top: 1px solid #ccc;width: 50%;
    height: 20px;
}
#hr-treeview li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}
#hr-treeview li:only-child::after, #hr-treeview li:only-child::before {
	display: none;
}
#hr-treeview li:only-child{ padding-top: 0;}
/*Remove space from the top of single children*/
/*Remove left connector from first child and 
right connector from last child*/
#hr-treeview li:first-child::before, 
#hr-treeview li:last-child::after{
	border: 0 none;
}
#hr-treeview li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
#hr-treeview li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}
#hr-treeview ul ul::before {
    content: '';
    position: absolute;
    top: 0px;
    left: 50%;
    border-left: 1px solid #ccc;
    width: 0;
    height: 20px;
}
/*Connector styles on hover*/
#hr-treeview li a:hover+ul li::after, 
#hr-treeview li a:hover+ul li::before, 
#hr-treeview li a:hover+ul::before, 
#hr-treeview li a:hover+ul ul::before{
	border-color:  #94a0b4;
}
#hr-treeview span.not{background:url('<?php echo ROOTHOST;?>images/tree-structure.png') no-repeat -409px 0px;width:70px;height:103px;line-height:21px;padding-top:7px; display:inline-block;position:relative;}
#hr-treeview span.blue{background:url('<?php echo ROOTHOST;?>images/tree-structure.png') no-repeat -340px 0px;position:relative;}
#hr-treeview span.not a{width: 100%;height:20px;white-space: nowrap;position:absolute;left:0px;bottom:-10px;}
#hr-treeview span.top-line,#hr-treeview span.bot-line{height:25px;width:1px;background:#999;position:absolute;left:50%;}
#hr-treeview span.top-line{top:-25px;}
#hr-treeview span.bot-line{bottom:-25px;}
#hr-treeview-wapper{width:100%; height:100%;position:relative;}
#hr-treeview-wapper #hr-treeview{width:100%;overflow:hidden;overflow-x:auto;padding:0px 21px 21px;}

#txt_code {
	background:url(../images/icon/selectbox.jpg) no-repeat center right;
}

</style>

<h2 align='center' class='title' style='margin: 0px;'>Danh sách thành viên</h2><br>
<form method='get' action='#' align="center" name="frmtreeview" id="frmtreeview">
Chọn User <input type='text' list='list_code' name='txt_code' id='txt_code' value=''/>
<datalist id='list_code'>
<?php getListByCode($user);?>
</datalist>
<input type='button' name='' id='btn_search' value='Hiển thị'/>
</form>
<?php
$sql="SELECT * FROM tbl_accounts WHERE `code`='$sub_code'";
$objmysql=new CLS_MYSQL;
$objmysql->Query($sql);
$r=$objmysql->Fetch_Assoc();
$subname=$r['name'];	
$subclass=''; if($r['type']>=2){$subclass="blue";}
$level=1;
function getListByCode($user){
	$obj_mysql=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_accounts WHERE `username`='$user'";
	$obj_mysql->Query($sql);
	while($r=$obj_mysql->Fetch_Assoc()){
		echo "<option>".$r['name'].'-'.$r['code']."</option>";
	}
}
function getTreeView($code,$subcode,$level){
	$sql="SELECT * FROM tbl_accounts WHERE `rep_user`='$subcode'";
	$objdata=new CLS_MYSQL;
	$objdata->Query($sql);
	$level++;
	if($level>4) return;
	$n=$objdata->Num_rows();
	if($n>0) echo "<ul>";
	while($r=$objdata->Fetch_Assoc()){
		$class='';
		if($r['type']>=2) $class='blue';
		$name=($r['type']!='' && $r['type']!=null )?$r['name']:'N/A';
		echo "<li>";
		echo "<span class='not $class'><a href='".ROOTHOST."my-network/$code/".$r['code']."' title='".$name."'>".$name."</a>";
		$number_sub=checkSub($r['code']);
		echo "</span>";
		getTreeView($code,$r['code'],$level);
		echo "</li>";
	}
	if($n>0) echo "</ul>";
}
function checkSub($code){
	$sql="SELECT * FROM `tbl_accounts` WHERE `rep_user`='$code'";
	$objdata=new CLS_MYSQL;
	$objdata->Query($sql);
	return $objdata->Num_rows();
}
$n=checkSub($sub_code);
?>
<div ID='hr-treeview-wapper'><div ID='hr-treeview'>
	<ul><?php if($code!=$sub_code) echo "<li class='root'><span class='not_root'><a href='".ROOTHOST."my-network/".$code."'>Root</a></span></li>";?>
		<li><span class='not <?php echo $subclass;?>' ><a href='' class='<?php echo $subname;?>'><?php echo $subname;?></a></span>
		<?php getTreeView($code,$sub_code,0);?>
		</li>
	</ul>
</div></div>
<script>
$(document).ready(function(){
	$('#btn_search').click(function(){
		var code = $('#txt_code').val();
		window.location = '<?php echo ROOTHOST;?>my-network/'+code;
	})
})
</script>
</div></div>