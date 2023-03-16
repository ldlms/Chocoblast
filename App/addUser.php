<?php
    include './utils/connectBdd.php';
    if(isset($_POST['submit'])){
        //tester si les champs sont remplis
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['password'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            if($_FILES['pfp']['tmp_name'] !=""){
            //stocker le contenu du formulaire
            $destination = "../Public/asset/image/";
            // A voir, pas sur du deuxième attribut
            move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
            echo "le fichier à bien été importé";
        }
        addArticleV3($bdd,$nom,$prenom,$mail,$password,$_FILES['pfp']['tmp_name'],1);
        echo 'l\'urilisateur à bien été ajouté à la BDD';
    }
        else{
            echo 'Veuillez remplir tous les champs du formulaire et corrige ton code';
        }
    }
    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }
    function addArticleV3($bdd, $nom, $prenom, $email,$password,$image,$user){
        //exécution du code SQL
        try{
            //récupération des paramètres
            $nom = $nom;
            $prenom = $prenom;
            $email = $email;
            $password = $password;
            $image = $_FILES['pfp']['tmp_name'];
            $user = 1;
            //préparation de la requête
            $req2 = $bdd->prepare('INSERT INTO `utilisateur`(`nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `password_utilisateur`, `image_utilisateur`,`id_roles`) VALUES (?, ?, ?, ?, ?, ?)');
            //affectation des variables
            $req2->bindParam(1, $nom, PDO::PARAM_STR);
            $req2->bindParam(2, $prenom, PDO::PARAM_STR);
            $req2->bindParam(3, $email, PDO::PARAM_STR);
            $req2->bindParam(4, $password, PDO::PARAM_STR);
            $req2->bindParam(5, $image, PDO::PARAM_STR);
            $req2->bindParam(6, $user, PDO::PARAM_STR);
            //exécution de la requête
            $req2->execute();
        }
        //gestion des erreurs (Exeception)
        catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
    }
?>