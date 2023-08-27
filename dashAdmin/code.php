<?php
function getPixels($imagePath)
    {
        $image = imagecreatefrompng($imagePath);    

        $width = imagesx($image);
        $height = imagesy($image);    

        $pixels = [];
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $rgb = imagecolorat($image, $x, $y);
                $color = imagecolorsforindex($image, $rgb);
                $pixels[$y][$x] = $color;
            }
        }    
        return $pixels;
    }
     function encryptPixels($pixels, $key)
     {
         $encryptedPixels = [];
        
         foreach ($pixels as $row) {
             $encryptedRow = [];
            
             foreach ($row as $pixel) {
                 $r = $pixel['red'];
                 $g = $pixel['green'];
                 $b = $pixel['blue'];
                
                 
                 $encryptedR = openssl_encrypt($r, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
                 $encryptedG = openssl_encrypt($g, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
                 $encryptedB = openssl_encrypt($b, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
                
                 $encryptedRow[] = [
                     'red' => $encryptedR,
                     'green' => $encryptedG,
                     'blue' => $encryptedB
                 ];
             }
            
             $encryptedPixels[] = $encryptedRow;
         }
        
         return $encryptedPixels;
     }
     function saveEncryptedPixels($encryptedPixels, $filePath)
    {
        
        $serializedPixels = serialize($encryptedPixels);
        
        
        file_put_contents($filePath, $serializedPixels);
    }
    

     function decryptPixels($encryptedPixels, $key)
    {
         $decryptedPixels = [];
        
         foreach ($encryptedPixels as $row) {
             $decryptedRow = [];
            
             foreach ($row as $encryptedPixel) {
                 $encryptedR = $encryptedPixel['red'];
                 $encryptedG = $encryptedPixel['green'];
                 $encryptedB = $encryptedPixel['blue'];
                
                 // Decrypt the pixel values using AES algorithm
                 $decryptedR = strval(openssl_decrypt($encryptedR, 'AES-256-ECB', $key, OPENSSL_RAW_DATA));
                 $decryptedG = strval(openssl_decrypt($encryptedG, 'AES-256-ECB', $key, OPENSSL_RAW_DATA));
                 $decryptedB = strval(openssl_decrypt($encryptedB, 'AES-256-ECB', $key, OPENSSL_RAW_DATA));
                
                 $decryptedRow[] = [
                     'red' => $decryptedR,
                     'green' => $decryptedG,
                     'blue' => $decryptedB
                 ];
             }
            
             $decryptedPixels[] = $decryptedRow;
         }
        
         return $decryptedPixels;

    }
    function loadEncryptedPixels($filePath)
    {
        // Read the serialized pixels from the binary file
        $serializedPixels = file_get_contents($filePath);
        
        // Unserialize the pixels
        $encryptedPixels = unserialize($serializedPixels);
        
        return $encryptedPixels;
    }
    function savePixels($pixels, $imagePath)
    {
        // Get the width and height of the pixels array
        $width = count($pixels[0]);
        $height = count($pixels);    
        // Create a new image resource
        $image = imagecreatetruecolor($width, $height);    
        // Loop through each pixel and set its color in the image
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $pixel = $pixels[$y][$x];
                $color = imagecolorallocate($image, intval($pixel['red']), intval($pixel['green']), intval($pixel['blue']));
                imagesetpixel($image, $x, $y, $color);
            }
        }    
        // Save the image to the specified path
        imagepng($image, $imagePath);
        
        // Destroy the image resource
        imagedestroy($image);
    }
    function createkey($id,$Name){
        $inital=0;
        for($i=0;$i<strlen($Name);$i++){
          $inital+=ord($Name[$i])*$i;
        }
        $lst =[];
        for($i=0;$i<32;$i++){
          $lst[$i]=$inital+$i;
        }
        for($i=0;$i<count($lst);$i++){
          if($id % 10 == 0)
          $lst[$i]=$lst[$i]*($id % 10)+$id;
          else
          $lst[$i]=$lst[$i]*($id % 11) + $id;
        }
        $key = implode("",$lst);
        return substr($key,0,32);
      }
    function encryptKey($key,$ID, $iv) {
        $encryptedKey = openssl_encrypt($key, 'AES-256-CBC',$ID , 0, $iv);
        return base64_encode($encryptedKey);
    }
    function decryptKey($encryptedKey, $ID, $iv){
        $encryptedKey = base64_decode($encryptedKey);
        $encrpytprc=openssl_decrypt($encryptedKey, 'AES-256-CBC', $ID, 0, $iv);
        return $encrpytprc;
    }

?>