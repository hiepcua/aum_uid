<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc_mysql.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.mysql1.php');

$strwhere = isset($_GET['strwhere'])? trim($_GET['strwhere']) : '';
$start = isset($_GET['start'])? (int)$_GET['start'] : 0;
$max_rows = isset($_GET['max_rows'])? (int)$_GET['max_rows'] : 0;

function listTable($strwhere="", $start=0, $max_rows){
	$strsql="$strwhere ORDER BY `cdate` DESC LIMIT $start,$max_rows";
	$res = SysGetList('tbl_group', [], $strsql);
	if(count($res)>0){
		$rowcount = $start;
		foreach ($res as $key => $rows) {
			$rowcount++;
			$this_id = $rows['code'];
			$name = stripslashes($rows['name']);
			$cdate = $rows['cdate']!=='' ? date('Y-m-d, H:i:s', $rows['cdate']) : null;
			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fa fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			echo "<tr data-code='".$this_id."'>";
			
			echo "<td width='50' align='center'>".$rowcount."</td>";
			echo "<td width='50' align='center'><i class='fa fa-trash' aria-hidden='true' data-code='".$this_id."' onclick='del()'></i></td>";
			echo "<td align='center'><a href='javascript: void(0)' data-code='".$this_id."' onclick='update()'>".$this_id."</a></td>";
			echo "<td><a href='javascript: void(0)' data-code='".$this_id."' onclick='update()'>".$name."</a></td>";
			echo "<td align='center'>".$cdate."</td>";
			echo "<td align='center'><a href='javascript: void(0)' onclick='active(this)' data-code='".$this_id."'>".$icon_active."</a></td>";
			echo "<td align='center'><a href='javascript: void(0)' data-code=".$this_id." onclick='update()'><i class='fa fa-edit'></i></a></td>";

			echo "</tr>";
		}
	}else{
		echo "<tr><td colspan='7' class='text-center'>Data is empty!</td></tr>";
	}
}
listTable($strwhere, $start, $max_rows);
?>
