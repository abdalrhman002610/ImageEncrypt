<?php include_once('A00_Security.php'); 
$_SESSION['menu']=1;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('A01_head.php'); ?>
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
								<div>
									<ul class="ace-thumbnails clearfix">										
							<?php 
											include_once('../connection.php');
											$name=$_SESSION['username'];
											$selectImage = mysqli_query($connect,"SELECT * FROM $name where created_from='$name' and typei='upload';");
											if(mysqli_num_rows($selectImage)>0){
												while($row=mysqli_fetch_assoc($selectImage)){
													$user_id = $row['id'];
													$user_image = $row['imageName'];
													echo '<li>
																<a href="users/'.$_SESSION['username'].'/UploadedImages/'.$user_image.'" title="Photo Title" data-rel="colorbox">
																	</fieldset>
																	<legend>'.$user_image.'</legend>
																	<img width="250" height="250" alt="150x150" src="users/'.$_SESSION['username'].'/UploadedImages/'.$user_image.'" />
																</fieldset>
																	</a>
																<div class="tags">
																	<span class="label-holder">
																		<span class="label label-info"></span>
																	</span>

																	<span class="label-holder">
																		<span class="label label-danger"></span>
																	</span>

																	<span class="label-holder">
																		<span class="label label-success"></span>
																	</span>

																	<span class="label-holder">
																		<span class="label label-warning arrowed-in"></span>
																	</span>
																</div>

																<div class="tools">
																	<a href="#">
																		<i class="ace-icon fa fa-link"></i>
																	</a>

																	<a href="#">
																		<i class="ace-icon fa fa-paperclip"></i>
																	</a>

																	<a href="#">
																		<i class="ace-icon fa fa-pencil"></i>
																	</a>

																	<a href="?getDEL='.$user_image.'">
															

																		<i class="ace-icon fa fa-times red"></i>
																	</a>
																</div>
															</li>';
												}
											}
											{//this code to delete the pictures from the database and the exsists file

											
													if(isset($_GET['getDEL'])){
														$image=$_GET['getDEL'];
														$file = 'users/'.$_SESSION['username'].'/UploadedImages/'.$image;
														if (file_exists($file)) {
															$query=mysqli_query($connect,"DELETE FROM ".$_SESSION['username']." where imageName='$image';");
														if(unlink($file)) {
															echo 'File deleted successfully.';
														} else {
															echo 'Unable to delete the file.';
														}
													}
												}
											}
											
							?>										
									</ul>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<?php include_once('A05_Footer.php'); ?>
	</body>
</html>
