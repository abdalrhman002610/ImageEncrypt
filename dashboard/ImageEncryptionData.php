<?php
include_once('../connection.php');
include_once('code.php');
if(isset($_POST['btnsub']) and isset($_POST['users'])){//send to selected user
    $uploadDirectory = 'users/'.$_SESSION['username'].'/UploadedImages/';
    $img=$_POST['img'];
    $user=$_POST['users'];
    $imagePath = $uploadDirectory.$img;

     {//Genterting the key 
            $keySize = 256; // Bit
            $key = openssl_random_pseudo_bytes($keySize / 8); //convert to bytes
            $key = bin2hex($key);//convert key to hexadecimal 
     }
    //Encrypting The Picture
    $pixelsThePicture=getPixels($imagePath);    //array
    $encryptedPixel=encryptPixels($pixelsThePicture,$key);
    if($user=="admin"){
        $uploadDirectory = '../dashAdmin/users/'.$user.'/EncryptedImages/';
        $new_file = substr($img,0,strrpos($img, "."));
        $uniqueFileName = uniqid().'_'.$new_file.'.data';
        saveEncryptedPixels($encryptedPixel,$uploadDirectory.$uniqueFileName);
    }
    if(!is_dir('users/'.$user.'/EncryptedImages'))
    if(!is_dir('users/'.$user))
    mkdir('users/'.$user);
    else
    mkdir('users/'.$user.'/EncryptedImages');
    if($user !="admin"){
        $uploadDirectory = 'users/'.$user.'/EncryptedImages/';
        $new_file = substr($img,0,strrpos($img, "."));
        $uniqueFileName = uniqid().'_'.$new_file.'.data';
        saveEncryptedPixels($encryptedPixel,$uploadDirectory.$uniqueFileName);
    }
    $ID=mysqli_query($connect,"SELECT ID From users where username='$user';");
    $ID=mysqli_fetch_array($ID)[0];
    $ID=createkey($ID,$user);//Uniuq key to encrypt the key 
    {// Securing the key before sending it to the database
        $IV = rand(1000000000000000,9999999999999999);
        $KeyENC = encryptKey($key,$ID,$IV); //Encrypting the key with using the id of the user.
        $keyEnc = $KeyENC.$IV; //conctainat the IV with the key to make it more sequre.
    }
    $date=date('Y-M-D');
    $time=date('H:i:s');
    $date=$date."|".$time;
    $query= mysqli_query($connect,"INSERT INTO $user VALUES (null,'$keyEnc','$uniqueFileName','".$_SESSION['username']."','$date','Encrypt');");
    if($query)
    echo '<h1 style="color:green">Image Encrypted Successfully and sent to '.$user.'</h1>';
}
else{//encrypt to the current user 
    if(isset($_POST['btnsub'])){
    $uploadDirectory = 'users/'.$_SESSION['username'].'/UploadedImages/';
    // Usage example:
    $img=$_POST['img'];
    $imagePath = $uploadDirectory.$img;
    {//Genterting the key 
        $keySize = 256; // Bit
        $key = openssl_random_pseudo_bytes($keySize / 8); //convert to bytes
        $key = bin2hex($key);//convert key to hexadecimal 
 }
    $pixelsThePicture=getPixels($imagePath);    
    $encryptedPixel=encryptPixels($pixelsThePicture,$key);
    if(!is_dir('users/'.$_SESSION['username'].'/EncryptedImages'))
    if(!is_dir('users/'.$_SESSION['username']))
    mkdir('users/'.$_SESSION['username']);
    else
    mkdir('users/'.$_SESSION['username'].'/EncryptedImages');
    else
    $uploadDirectory = 'users/'.$_SESSION['username'].'/EncryptedImages/';
    $new_file = substr($img,0,strrpos($img, "."));
    $uniqueFileName = uniqid().'_'.$new_file.'.data';
    $ID = $_SESSION['id'];
    $ID=createkey($ID,$_SESSION['username']);
    saveEncryptedPixels($encryptedPixel,$uploadDirectory.$uniqueFileName);
     {// تأمين المفتاح قبل أرساله الى الداتابيز
        $IV = rand(1000000000000000,9999999999999999);
        $KeyENC = encryptKey($key,$ID,$IV); //Encrypting the key with using the id of the user.
        $keyEnc = $KeyENC.$IV; //conctainat the IV with the key to make it more sequre.
    }
    $date=date('Y-M-D');
    $time=date('H:i:s');
    $date=$date."|".$time;
    $query= mysqli_query($connect,"INSERT INTO ". $_SESSION['username']. " VALUES (null,'$keyEnc','$uniqueFileName','".$_SESSION['username']."','$date','Encrypt');");    
    if($query)
    echo '<h1 style="color:green">Image Encrypted Successfully and sent to you.</h1>';
}
}
?>
<div class="container2">
    <form action="" method="POST">  
        <div class="row">
		    <div class="col-25">
                <label for="images">Select Image</label>
            </div>
        </div>
        <div class="row">
		    <div class="col-75">
                <select name="img" required>
                <option value="">Select image</option>
                    <?php
                        $name=$_SESSION['username'];//jamal
                        $imgs=mysqli_query($connect,"SELECT imageName FROM $name WHERE typei='upload';");
                        while($row = mysqli_fetch_assoc($imgs)){
                            echo "<option value=".$row['imageName'].">".$row['imageName']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
		    <div class="col-25">
                <label for="users">Select User</label>
            </div>
        </div>
        <div class="row">
		    <div class="col-75">
            <select name="users">
                <option value="0" selected disabled >Select User</option>
                <?php
                    $q2=mysqli_query($connect,"SELECT username from users where username <> '".$_SESSION['username']."';");
                    while($row2 = mysqli_fetch_assoc($q2)){
                        echo "<option value=".$row2['username'].">".$row2['username']."</option>";
                    }
                ?>
            </select>
            </div>
        </div>
        <br>
			<div class="row" style="padding-right: 25%;">
				<input type="submit" name="btnsub" value="Send">
			</div>      
        
    </form> 
</div>