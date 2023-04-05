<?php
if(!isset($_SESSION['prenom'])){
$message = 'Veuillez vous connecter pour accéder au site';
}else{
$message = 'Bienvenue '.$_SESSION['prenom'];
}


include './App/vue/view_acceuil.php';
?>