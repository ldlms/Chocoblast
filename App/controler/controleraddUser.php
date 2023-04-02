<?php
    include './App/model/utilisateur.php';
    include './App/manager/managerUtilisateur.php';
    
    $message = "veuillez renseigner vos informations";
    if(isset($_POST['submit'])){
        //tester si les champs sont remplis, et si le mail est conforme, suivi du nettoyage
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) AND !empty($_POST['password'])){
            $nom = fonction::cleanData($_POST['nom']);
            $prenom = fonction::cleanData($_POST['prenom']);
            $mail = fonction::cleanData($_POST['mail']);
            $password = fonction::cleanData($_POST['password']);
            $image = $_FILES['pfp']['tmp_name'];
            $inscrit = new Utilisateur($nom,$prenom,$mail,$password);
            $destination = "./public/asset/image/".$_FILES['pfp']['name'].'';
            $bdd = BddConnect::connexion();
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                $message = 'e-mail non valide';
            } else {
                    if($_FILES['pfp']['tmp_name'] !=""){
                        move_uploaded_file($image,$destination);
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

    include './App/vue/view_add_user.php';
?>