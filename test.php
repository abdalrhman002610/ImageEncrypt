<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<?php include_once('head.php');?>
<link rel="stylesheet" href="mystyle.css">
</head>

<body>
 <?php
 include_once('connection.php');
 $msg='';
 $name='';

    if(isset($_POST['btnLogin'])){
        $user = $_POST['username'];
        $pass = $_POST['userpass'];

        $check= mysqli_query($connect,"SELECT * FROM users WHERE username='$user' AND userpass='$pass';");

        if(mysqli_num_rows($check)>0){
            while($row=mysqli_fetch_assoc($check)){
                $name= $row['myname'];
                $_SESSION['USERNAME'] = $user;
                
            }
            $msg="Welcome: ".$_SESSION['USERNAME'];
            // header('location: users/');
        }else{
            $msg='ERROR';
        }
    }
        
 ?>
<?php include_once('menu.php');?>
<br><br>
<form class="form-horizontal" style="margin-left: 25%;" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="Rememberme" name="Rememberme"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default"  name="btnLogin" value="Sign in">
    </div>
  </div>
</form>

<div style="text-align: center;">
<br><hr><br>
 <?php echo $_SESSION['USERNAME'];?>
</div> 

<?php include_once('footer.php');?>
</body>
</html>