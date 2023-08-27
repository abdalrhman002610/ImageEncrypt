<?php
session_start();
ob_start();
if(!isset($_SESSION['id'])){
    Header('Location: ../');
}
$_SESSION['menu']=1;
?>