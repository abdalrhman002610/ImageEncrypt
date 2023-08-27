<?php
include_once('../connection.php');
$info =mysqli_query($connect,"SELECT * from users WHERE id='".$_SESSION['id']."';");
$id ='sdgsfg';
$fullname ='';
$email ='';
$username ='';
$userpass ='';
while($row= mysqli_num_rows($info)){
    $id =$row['id'];
    $fullname =$row['fullname'];
    $email =$row['email'];
    $username =$row['username'];
    $userpass =$row['userpass'];
}
?>
<div class="container">
  <form action="" method="post">
  <div class="row">
    <div class="col-25">
      <label for="fname">User ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="id" name="id" value="<?php echo $id;?>" readonly>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="lastname" placeholder="Your last name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Country</label>
    </div>
    <div class="col-75">
      <select id="country" name="country">
        <option value="australia">Australia</option>
        <option value="canada">Canada</option>
        <option value="usa">USA</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Subject</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>