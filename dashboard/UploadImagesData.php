
<?php
include_once('../connection.php');
if(isset($_POST['btnUpload'])){    
    $imageName="";
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        // File details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size']; // by byte
        $fileError = $file['error'];
    
        // Get the file extension
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        // Convert the extension to lowercase
        $extension = strtolower($extension);
        $newNamefile=str_replace('.'.$extension,'',$fileName);
        // Check for errors
        if ($fileError === UPLOAD_ERR_OK) {
            // Specify the directory to which you want to upload the image
            $uploadDirectory = 'users/'.($_SESSION['username']).'/UploadedImages/';
            // Generate a unique name for the uploaded image
            $uniqueFileName = $newNamefile.'_'.uniqid().'.'.$extension;
            // Move the uploaded file to the desired location
            $destination = $uploadDirectory . $uniqueFileName;
            if (move_uploaded_file($fileTmpName, $destination)) {
                
                echo "<h2 style='color:green'>File uploaded successfully! </h2>";
            } else {
                echo "<h2 style='color:red'>Failed to upload the file.</h2>";
            }
        } else {
            echo "Error: " . $fileError;
        }
    }
    $date=date('Y-M-D');
    $time=date('H:i:s');
    $date=$date."|".$time;
    $name=$_SESSION['username'];
    $query= mysqli_query($connect,"INSERT INTO $name VALUES (null,'','$uniqueFileName','$name','$date','Upload');");
    // $query2= mysqli_query($connect,"INSERT INTO imagespath VALUES (null,'$uniqueFileName','$name','','','');");

}