<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Image Encryption</title>
    <?php include_once('head.php');?>
    
  </head>
<body> 
  <?php include_once('menu.php');
  include_once('connection.php');
  $message='';
  if (isset($_POST['btnLogin'])){
    $username = strtolower($_POST['username']);
    $pass1 = $_POST['pass1'];
    $c = mysqli_query($connect,"SELECT userpass FROM users where username='$username' or email='$username';");
    if(mysqli_num_rows($c)){
      $hashed_pass = mysqli_fetch_array($c)[0];
    if(password_verify($pass1,$hashed_pass))
      $pass1=$hashed_pass;
    }
    $checkAccount = mysqli_query($connect,"SELECT * FROM users WHERE (username='$username' or email='$username') AND userpass='$pass1';");
        if(mysqli_num_rows($checkAccount)){
        while($row=mysqli_fetch_assoc($checkAccount)){
          $id = $row['id'];//2
          $fullname = $row['fullname'];//abdalrhman
          $user=$row['username'];//jamal
        }
        $_SESSION['id']=$id;
        $_SESSION['fullname']=$fullname;
        $_SESSION['username']=$user;

{
        if($user =="admin" ){//admin users
            $createtable=mysqli_query($connect,"CREATE TABLE IF NOT EXISTS $user(id INT AUTO_INCREMENT PRIMARY KEY , keyENC varchar(200) null , imageName varchar(100), created_from varchar(20) null,created_date varchar(20) null , typei varchar(10) null);");
            Header('Location: dashAdmin/');
            if(!is_dir('dashAdmin/users'))
            mkdir('dashAdmin/users/');
          $folder='dashAdmin/users/'.$user;//dashAdmin/users/admin 
          if(!is_dir($folder))
            mkdir($folder);
          if(!is_dir($folder.'/UploadedImages'))//dashAdmin/users/admin/UplaodedImages
          mkdir($folder.'/UploadedImages');
          if(!is_dir($folder.'/EncryptedImages'))
          mkdir($folder.'/EncryptedImages');
          if(!is_dir($folder.'/DecryptedImages'))
          mkdir($folder.'/DecryptedImages');    
            
        }

 }

{//Normal User
    if( $user != "admin"){ //mysqli_num_rows($checkAccount) and
        // $username=mysqli_query($connect,"SELECT username from users where username='$username' or email='$username';");
        // $username=mysqli_fetch_array($username)[0];
      {//Check directpries 
              if(!is_dir('dashboard/users'))
                mkdir('dashboard/users/');
              $folder='dashboard/users/'.$user;
              if(!is_dir($folder))
                mkdir($folder);
              $subfolder=$folder.'/';
              if(!is_dir($folder.'/UploadedImages'))
              mkdir($folder.'/UploadedImages');
              if(!is_dir($folder.'/EncryptedImages'))
              mkdir($folder.'/EncryptedImages');
              if(!is_dir($folder.'/DecryptedImages'))
              mkdir($folder.'/DecryptedImages');    
      }
              $createtable=mysqli_query($connect,"CREATE TABLE IF NOT EXISTS $user(id INT AUTO_INCREMENT PRIMARY KEY , keyENC varchar(200) null , imageName varchar(100), created_from varchar(20) null,created_date varchar(20) null , typei varchar(10) null);");
                Header('Location: dashboard/');
            }
  }
}else{
  $message = "Invalid username or password";
}

}
  


?>
  <section class="about_section layout_padding mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="img-box">
            <img src="images/login.webp" alt="" />
          </div>
        </div>
        <div class="col-md-5">
          <div class="detail-box">
            <section class="contact_section">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-10 offset-lg-2 col-md-5 offset-md-1">
                    <h2 class="custom_heading">Login</h2>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div>
                          <input type="text" placeholder="Username or Email" name="username" required/>
                        </div>
                        <div>
                          <input type="password" placeholder="Password" name="pass1" required/>
                        </div>
                        <div class="d-flex  col-lg-6 ">
                          <input type="submit" value="Login" name="btnLogin"/>
                        </div>
                      </form>
                      <div style="width: 100%;text-align: center;color:#FF0000;">
                        <?php echo $message;?>
                      </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>  
<?php include_once('footer.php');?>
</body>
</html>