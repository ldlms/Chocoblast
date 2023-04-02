<?php
    session_start();
    if(isset($_POST['submit'])){
        $nom = fonction::cleanData($_POST['login']);
        $bdd = BddConnect::connexion();
        $stmt = $bdd->prepare("SELECT nom_utilisateur FROM utilisateur WHERE nom_utilisateur=?");
        $stmt->execute([$nom]);
        $user = $stmt->fetch();
        if($user){
            $_SESSION['login'] = $_POST['login'];
            $message = "bienvenue ".$nom;
        }else{
            $message = "veuillez vous inscrire avant de vous connecter";
        }
    } else {
        $message ='';
    }

    include './App/vue/view_connect_user.php';
?>