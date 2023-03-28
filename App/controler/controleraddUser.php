<?php
    include '../utils/connectBdd.php';
    include '../model/utilisateur.php';
    include '../manager/managerUtilisateur.php';
    
    $message = "veuillez renseigner vos informations";
    if(isset($_POST['submit'])){
        //tester si les champs sont remplis, et si le mail est conforme, suivi du nettoyage
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) AND !empty($_POST['password'])){
            $nom = valid_donnees($_POST['nom']);
            $prenom = valid_donnees($_POST['prenom']);
            $mail = valid_donnees($_POST['mail']);
            $password = valid_donnees($_POST['password']);
            $inscrit = new Utilisateur($nom,$prenom,$mail,$password);
            $destination = "../../Public/asset/image/";
            $bdd = BddConnect::connexion();
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                $message = 'e-mail non valide';
            } else {
                    if($_FILES['pfp']['tmp_name'] !=""){
                        move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                        $inscrit->insertUser($bdd);
                        $message = "le fichier à bien été importé et le compte crée<br>";
                    }else{
                        $_FILES['pfp']['tmp_name'] = "C:\Users\leode\Desktop\xhomp\htdocs\choco\Public\asset\image\blank-profile-picture-973460_960_720-1.png";
                        $inscrit->insertUser($bdd);
                        move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                        $message = "Profil crée avec image générique";
                    }
                }
            }else{
                $message = "Veuillez renseigner correctement tous les champs";
            }
        }else{
        $message = 'remplissez tout les champs';
    }

    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlentities($donnees);
        $donnees = strip_tags($donnees);
        return $donnees;
    }

    include '../vue/view_add_user.php';
?>