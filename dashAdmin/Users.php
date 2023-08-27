<?php include_once('A00_Security.php'); 
$_SESSION['menu']=7;
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
							<h1>
							Image Decryption
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">

<?php 
include('../connection.php');
include('formatUser.php');
$query = mysqli_query($connect,"SELECT * from users where username<>'admin';");
if(mysqli_num_rows($query)){
echo "<table class='styled-table' >";
echo'<thead>
        <tr>
            <th>id</th>
            <th>fullname</th>
            <th>email</th>
            <th>username</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>';
}
else
echo "There are no Users";
while($row=mysqli_fetch_assoc($query)){
    echo '
    <tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['fullname'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['username'].'</td>
        <td>
        <a href="?userDEL='.$row['username'].'">
            <button class="delete-button">Delete</button>
        </a>
    </tr>';

}
function deleteDirectory($dirPath) {

        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDirectory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
echo '</tbody></table>';
if(isset($_GET['userDEL'])){
    $deluser=mysqli_query($connect,"drop table if exists ".$_GET['userDEL'].";");
    $deluser2=mysqli_query($connect,"delete from users where username='".$_GET['userDEL']."';");
    if(is_dir('../dashboard/users/'.$_GET['userDEL'])){
    deleteDirectory('../dashboard/users/'.$_GET['userDEL']);
    }
}



?>
</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php include_once('A05_Footer.php'); ?>
	</body>
</html>
