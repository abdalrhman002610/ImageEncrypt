
<?php
include_once('../connection.php');
$name=$_SESSION['username'];
$ENC_IMAGE='';
$ENC_IMAGE_KEY='';
if(isset($_POST['btnDecrypt'])){
    $img=$_POST['encpic'];
    $imageNAME= '';
    $KEY_IMAGE= '';
    $getImageInfo = mysqli_query($connect,"SELECT * FROM $name WHERE imageName='$img'");
    if(mysqli_num_rows($getImageInfo)){
        while($row= mysqli_fetch_assoc($getImageInfo)){
            $imageNAME= $row['imageName'];
            $KEY_IMAGE= $row['keyENC'];
            $created_from= $row['created_from'];
        }
    }
    if($KEY_IMAGE!=''){
        $uploadDirectory = 'users/'.$name.'/EncryptedImages/';
        $imagePath = $uploadDirectory.$imageNAME;
        include_once('code.php');
        $ENCkey = mysqli_query($connect,"SELECT keyENC from $name where imageName = '$imageNAME';");
        $ENCkey=mysqli_fetch_array($ENCkey)[0];
        $IV = substr($ENCkey,-16); //get the last 16 charchtar from the key that come from dataBase
        $key= substr($ENCkey,0,strlen($ENCkey)-16); //get the key except the last 16 charctar
        $id=createkey($_SESSION['id'],$_SESSION['username']);
        $key=decryptKey($key,$id,$IV);
        $pixelsThePicture=loadEncryptedPixels($imagePath);    
        $uploadDirectory = 'users/'.$name.'/DecryptedImages/';
        $new_file = substr($imageNAME,0,strrpos($imageNAME, "."));
        // $myNameFile = $new_file.'.png';
        $uniqueFileName = uniqid().'_'.$new_file.'.png';
        $DecPixles= decryptPixels($pixelsThePicture,$key);
        savePixels($DecPixles,$uploadDirectory.$uniqueFileName);
        $date=date('Y-M-D');
        $time=date('H:i:s');
        $date=$date."|".$time;
        $query= mysqli_query($connect,"INSERT INTO ".$_SESSION['username']." VALUES (null,'','$uniqueFileName','".$created_from."','$date','decrypt');");
        if($query)
        echo '<h1 style="color:green">Image Decrypted Successfully</h1>';

    }


    

}
?>
  <div class="container2">
    <form action="" method="POST">
        <div class="row">
		    <div class="col-25">
                <label for="select"><b>select an image:</b></label><br>
            </div>
        </div>
        <div class="row">
		    <div class="col-75">
                <select name="encpic">
                    <option selected>Select</option>
                    <?php
                        $query=mysqli_query($connect,"SELECT * FROM $name WHERE keyENC<>'';");
                        while($row = mysqli_fetch_assoc($query)){
                            echo "<option value=".$row['imageName'].">".$row['imageName']."</option>";
                        }                                                                           
                    ?>
                </select>
            </div>
        </div>
        <br>
			<div class="row" style="padding-right: 25%;">
            <input type="submit" name="btnDecrypt" value="Decrypt">
			</div>
        <br>
        </div>
    </form>    
  </div>
<br/>

 </div>