<?php
    if(isset($_POST['submit'])){
        $password = fonction::cleanData($_POST['password']);
        $mail = fonction::cleanData($_POST['mail']);
        $connecte = new ManagerUtilisateur(null,null,$mail,$password);
        // var_dump($connecte);
        $result = $connecte->getUserByMail();
        if($result){
            if(password_verify($password,$result[0]["password_utilisateur"])){
            $_SESSION['prenom'] = $result[0]["prenom_utilisateur"];
            $_SESSIOn['mail'] = $result[0]['mail_utilisateur'];
            $message = "bienvenue ".$_SESSION['prenom'];
            }else{
                $message = 'mauvais mot de passe';
            }

        }else{
            $message = "veuillez vous inscrire avant de vous connecter";
        }
    } else {
        $message ='';
    }

    include './App/vue/view_connect_user.php';
?>