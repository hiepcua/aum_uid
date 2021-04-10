<?php
$username=getInfo('username');
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="navbar-header">
		<div class="pull-left">
			<a class="navbar-brand" href="<?php echo ROOTHOST;?>">AUM UID</a>
		</div>
		<button type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="right-sidebar" class="navbar-toggle collapsed">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="navbar" class="navbar-collapse collapse" menu="">
		<div class="pull-left">
			<ul class="nav navbar-nav">
				<li>
					<a href=""><i class="fa fa-list" aria-hidden="true"></i> Danh mục</a>
					<ul class="submenu">
						<li><a href="<?php echo ROOTHOST;?>phongban">Phòng ban</a></li>
						<li><a href="<?php echo ROOTHOST;?>chucvu">Chức vụ</a></li>
						<li><a href="<?php echo ROOTHOST;?>">Quản lý site</a></li>
					</ul>
				</li>
				<li><a href="<?php echo ROOTHOST;?>"><i class="fa fa-users" aria-hidden="true"></i> Quản lý nhân sự</a></li>
				<li><a href="<?php echo ROOTHOST;?>"><i class="fa fa-object-group" aria-hidden="true"></i> Phân quyền</a></li>
			</ul>
		</div>
		<div class="pull-right user_module">
			<div class="btn-group form-profile"><ul class="main-menu">
				<?php $com=isset($_GET['com'])?$_GET['com']:'';?>
				<li><a href="<?php echo ROOTHOST;?>members">
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Member</span>
				</a></li>
			</ul></div>
			<div class="btn-group form-profile">
				<div class="action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<a href="#" id="nav_registry" ><span class='avatar-small'><i class="fa fa-user fa-2" aria-hidden="true"></i></span> <?php echo $username;?> </a><i class="fa fa-caret-down" aria-hidden="true"></i>
				</div>
				<ul class="dropdown-menu pull-right">
					<li><a href="<?php echo ROOTHOST;?>account"><i class="fa fa-info-circle"></i> My Account</a></li>
					<li><a href="<?php echo ROOTHOST;?>changepass"><i class="fa fa-key"></i> Change password</a></li>
					<?php if(getInfo('isadmin')=='yes'){?>
						<li><a href="<?php echo ROOTHOST;?>user">
							<i class="fa fa-user" aria-hidden="true"></i> <span>Quản lý Users</span>
						</a></li>
					<?php }?>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" class='logout' rel="nofollow,noindex"><i class="fa fa-power-off"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<script>
	$('.logout').click(function(){
		$.get('<?php echo ROOTHOST;?>ajaxs/mem/logout.php',function(req){
			console.log(req);
			window.location.reload();
		});
	})
</script>