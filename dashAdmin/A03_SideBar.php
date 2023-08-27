<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
</script>
<?php
$MENU=1;
if(isset($_SESSION['menu'])){
	$MENU=$_SESSION['menu'];
}else{
	$MENU=1;
}
?>
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php echo ($MENU==1?'active':'');?>">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php echo ($MENU==2?'active':'');?>">
						<a href="UploadImages.php">
							<i class="menu-icon fa fa-upload"></i>
							<span class="menu-text"> Upload </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php echo ($MENU==3?'active':'');?>">
						<a href="ImageEncryption.php">
							<i class="menu-icon fa fa-lock"></i>
							<span class="menu-text"> Image Encryption </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php echo ($MENU==4?'active':'');?>">
						<a href="ImageDecryption.php">

							<i class="menu-icon fa fa-unlock"></i>
							<span class="menu-text"> Image Decryption </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php echo ($MENU==5?'active':'');?>">
						<a href="ShowImageDecryption.php">
							
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text"> Decrypted Images </span>
						</a>

						<b class="arrow"></b>
					</li>	
					<li class="<?php echo ($MENU==6?'active':'');?>">
						<a href="messages.php">
							<i class="menu-icon fa fa-bell" ></i>
							<span class="menu-text"> Messages </span>
						</a>

						<b class="arrow"></b>
					</li>		
					<li class="<?php echo ($MENU==7?'active':'');?>">
						<a href="Users.php">
							<i class="menu-icon fa fa-users" ></i>
							<span class="menu-text"> Users </span>
						</a>

						<b class="arrow"></b>
					</li>			
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>