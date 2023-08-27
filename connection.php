<?php
$SERVER="localhost";
$USER='root';
$PASSWORD='';
$DATABASE='imagesdb';
$conncet=mysqli_connect($SERVER,$USER,$PASSWORD);//function to connect to the database 
$chDB=mysqli_query($conncet,"CREATE DATABASE if not exists $DATABASE ;");
$connect = mysqli_connect($SERVER,$USER,$PASSWORD,$DATABASE);
if($connect){
    echo '';
}else{
    echo 'Connect Error';
    echo "<br><b> <h3>please check the localserver and make sure you are created database with name $DATABASE </h3></b>";
}
?>
