<?php
session_start();
if(!isset($_SESSION['login'])){
$message = 'Veuillez vous connecter pour accéder au site';
}else{
$message = 'Bienvenue '.$_SESSION['login'];
}


include './App/vue/view_acceuil.php';
?>