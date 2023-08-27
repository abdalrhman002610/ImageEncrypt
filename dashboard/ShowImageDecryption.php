<?php include_once('A00_Security.php'); 
$_SESSION['menu']=5;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('A01_head.php'); ?>
		<link rel="stylesheet" href="../css/abd.css">
	</head>
	<body class="no-skin">
		<?php include_once('A02_NavBar.php'); ?>
		<div class="main-container ace-save-state" id="main-container">
			<?php include_once('A03_SideBar.php'); ?>
            <div class="main-content">
				<div class="main-content-inner">					
					<div class="page-content">						
						<div class="page-header">
							<h1>
								My Decryption Images
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->
                        <?php
                        include_once('../connection.php');
                        $user=$_SESSION['username'];
                        $selectImage = mysqli_query($connect,"SELECT * from $user where typei like 'decrypt' AND imageName not like '%.data';");

						?>
						<div class="row">
							<div class="col-xs-12 abd">
                                <!-- PAGE CONTENT BEGINS -->
                                <?php
                                 if(mysqli_num_rows($selectImage)>0){
                                     while($row=mysqli_fetch_assoc($selectImage)){
                                         $imagename = $row['imageName'];
										 $from=$row['created_from'];
										 $date=$row['created_date'];
										 $keyENC=$row['keyENC'];
										$uploadDirectory = 'users/'.$user.'/DecryptedImages/';
										$image = $uploadDirectory.$imagename;
											echo '<fieldset>
											<legend>'.'from '.$from.'</legend>

											<img src='.$image.' alt="Image">
											<a href="?getDEL='.$imagename.'">
															

											<i class="ace-icon fa fa-times red"></i>
										</a>
											</fieldset>';
										
										
                                    }
                                 }
                                ?>
								<?php
							{//this code to delete the pictures from the database and the exsists file		
									if(isset($_GET['getDEL'])){
										$image=$_GET['getDEL'];
										$file = 'users/'.$_SESSION['username'].'/DecryptedImages/'.$image;
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

                            </div>
                        </div>
                    </div>        
                </div>			
            </div>											
        </div>				
		<?php include_once('A05_Footer.php'); ?>
	</body>
</html>
