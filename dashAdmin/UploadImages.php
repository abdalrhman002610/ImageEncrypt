<?php include_once('A00_Security.php'); 
$_SESSION['menu']=2;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('A01_head.php'); ?>
		<?php include_once('formatForm.php'); ?>
		
	</head>
	<body class="no-skin">
		<?php include_once('A02_NavBar.php'); ?>
		<div class="main-container ace-save-state" id="main-container">
			<?php include_once('A03_SideBar.php'); ?>	
			<div class="main-content">
				<div class="main-content-inner">					
					<div class="page-content">						
						<div class="page-header">
							<h1>My Upload Images<small><i class="ace-icon fa fa-angle-double-right"></i></small></h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php include_once('UploadImagesData.php') ?>
								
	<div class="container2">
		<form action="" method="POST" enctype="multipart/form-data">			
			<div class="row">
				<div class="col-25">
				<label for="image">Select an image:</label>
				</div>
				<div class="col-75">
				<input type="file" id="image" name="image" accept="image/png" required>

				</div>
			</div>		
			<br>
			<div class="row">
				<input type="submit" name="btnUpload" value="Upload Image">
			</div>

		</form>
	</div>

								<br/>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		<?php include_once('A05_Footer.php'); ?>
	</body>
</html>
