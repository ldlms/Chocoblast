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
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                echo 'e-mail non valide';
                exit;
            } else {
                addArticleV3($bdd,$nom,$prenom,$mail,$password,$_FILES['pfp']['tmp_name'],1);
                if($_FILES['pfp']['tmp_name'] !=""){
                move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                echo "le fichier à bien été importé et le compte crée";
            } 
        }
    }else{
            // boucle d'image manquante
            $_FILES['pfp']['tmp_name'] = ".../Public/asset/image/blank-profile-picture-973460_960_720-1.png";
            $destination = "../Public/asset/image/";
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                echo 'e-mail non valide';
                exit;
            } else {
                addArticleV3($bdd,$nom,$prenom,$mail,$password,$_FILES['pfp']['tmp_name'],1);
                if($_FILES['pfp']['tmp_name'] !=""){
                move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                echo "le fichier à bien été importé et le compte crée";
            } 
          }
        }
    }else{
        echo 'remplissez tout les champs';
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
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $image = $_FILES['pfp']['tmp_name'];
            $user = 1;
            //préparation de la requête
            $req2 = $bdd->prepare('INSERT INTO `utilisateur`(`nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `password_utilisateur`, `image_utilisateur`,`id_roles`) VALUES (?, ?, ?, ?, ?, ?)');
            //affectation des variables
            $req2->bindParam(1, $nom, PDO::PARAM_STR);
            $req2->bindParam(2, $prenom, PDO::PARAM_STR);
            $req2->bindParam(3, $email, PDO::PARAM_STR);
            $req2->bindParam(4, $hashed, PDO::PARAM_STR);
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