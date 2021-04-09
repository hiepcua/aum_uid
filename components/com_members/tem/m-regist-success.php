<?php
if(!isLogin()){
?>
<div class='col-sm-4'></div>
<div class='col-sm-4'>
	<div class='main-panel'>
		<div class='header'>
			<div class='text-center'>
				<h2 class='title'></h2>
			</div>
		</div>
		<div class='main'>
			<div class='frm'>
				<h3 class='title text-center'>SUCCESS</h3>
				<div class='form'>
					<div class='form-group text-center' style='font-size:16px;'>Check your email for register confirmation. We'll see you soon!</div>
					<div class='form-group'>
						<a href='<?php echo ROOTHOST;?>' class='btn btn-block btn-success' >OK</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class='col-sm-4'></div>
<?php	
}else{
	header('location:'.ROOTHOST);
}
?>