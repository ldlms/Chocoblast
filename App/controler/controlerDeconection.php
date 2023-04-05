<?php
$message ='';
if(isset($_SESSION['prenom'])){
    $message = $_SESSION['prenom'].' est bien deconnecté';
}else{
    $message = 'Vous n\'étes pas connecté';
}
session_destroy();

include './App/vue/view_deconnection.php'
?>