<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register Image Encryption</title>
    <?php include_once('head.php');?>
  </head>
  <body>
    <?php include_once('menu.php');
    include_once('connection.php');
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
    $createtable=mysqli_query($connect,"CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY,fullname varchar(100) null , email varchar(150) null , username varchar(100) null , userpass varchar(200));");
    $message='';
    if (isset($_POST['btnReg'])){
      $fullname = $_POST['fullname'];
      $email = $_POST['email'];

      $username = strtolower($_POST['username']);
      $pass1 = password_hash($_POST['pass1'],PASSWORD_ARGON2I);

      $pass2 = $_POST['pass2'];
      $checkUSER = mysqli_query($connect,"SELECT id FROM users WHERE username='$username';");
      $checkEmail = mysqli_query($connect,"SELECT id FROM users WHERE email='$email';");
      if(mysqli_num_rows($checkUSER)!=0){
        $message = "Username is not available!";
      }else if(mysqli_num_rows($checkEmail)!=0){
        $message = "Email is not available!";
      }else if(!password_verify($pass2, $pass1)){
        $message = "Passwords do not match!";
      }else{
        
        $sql = mysqli_query($connect,"INSERT INTO users values(null,'$fullname','$email','$username','$pass1');");
        if($sql){
          $message = "Registration Successfully";

        if($username =="admin"){
          if(!is_dir('dashAdmin/users'))
          mkdir('dashAdmin/users/');
          $folder='dashAdmin/users/'.$username;
          if(is_dir($folder))
          deleteDirectory($folder);
        mkdir($folder);   
        if(is_dir($folder.'/UploadedImages'))
        deleteDirectory($folder.'/UploadedImages');
        if(is_dir($folder.'/EncryptedImages'))
        deleteDirectory($folder.'/EncryptedImages');
        if(is_dir($folder.'/DecryptedImages'))
        deleteDirectory($folder.'/DecryptedImages');

        mkdir($folder.'/UploadedImages');
        mkdir($folder.'/EncryptedImages');
        mkdir($folder.'/DecryptedImages'); 
        }

        if($username!="admin"){
          if(!is_dir('dashboard/users'))
          mkdir('dashboard/users/');
          $folder='dashboard/users/'.$username;
          if(is_dir($folder))//just check if the admin folder is exists 
          deleteDirectory($folder);

        mkdir($folder);   
        if(is_dir($folder.'/UploadedImages'))
        deleteDirectory($folder.'/UploadedImages');

        if(is_dir($folder.'/EncryptedImages'))
        deleteDirectory($folder.'/EncryptedImages');

        if(is_dir($folder.'/DecryptedImages'))
        deleteDirectory($folder.'/DecryptedImages');

        mkdir($folder.'/UploadedImages');
        mkdir($folder.'/EncryptedImages');
        mkdir($folder.'/DecryptedImages');   
        }  
          $droptable=mysqli_query($connect,"drop table if EXISTS $username;");
          $createtable=mysqli_query($connect,"CREATE TABLE IF NOT EXISTS $username(id INT AUTO_INCREMENT PRIMARY KEY , keyENC varchar(200) null , imageName varchar(100), created_from varchar(20) null,created_date varchar(20) null , typei varchar(10) null);");
        }else{
          $message = "Registration Failed";
        }
      }
    }

    ?>
    <section class="contact_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1">
            <h2 class="custom_heading">Register Now</h2>
            <form action="" method="post">
              <div>
                <input type="text" placeholder="Full Name" name="fullname" required/>
              </div>
              <div>
                <input type="email" placeholder="Email" name="email" required/>
              </div>
              <div>
                <input type="text" placeholder="Username" name="username" required/>
              </div>
              <div>
                <input type="password" placeholder="Password" name="pass1" required/>
              </div>
              <div>
                <input type="password" placeholder="Retype Password" name="pass2" required/>
              </div>
              <div class="d-flex  mt-4 ">
                <input type="submit" value="Register" name="btnReg"/>
              </div>
            </form>
            <div style="width: 100%;text-align: center;color:#FF0000;">
              <?php echo $message;?>
            </div>
          </div>
          <div class="col-md-5 px-0">
            <div class="img-box">
              <img src="images/Encryption-vs-Decryption.jpg" alt="" class="w-100" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include_once('footer.php');?>
  </body>
</html>