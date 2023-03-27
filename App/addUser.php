<?php
    include './utils/connectBdd.php';
    include './model/utilisateur.php';
    
    if(isset($_POST['submit'])){
        //tester si les champs sont remplis, et si le mail est conforme, suivi du nettoyage
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) AND !empty($_POST['password'])){
            $nom = valid_donnees($_POST['nom']);
            $prenom = valid_donnees($_POST['prenom']);
            $mail = valid_donnees($_POST['mail']);
            $password = valid_donnees($_POST['password']);
            $inscrit = new Utilisateur($nom,$prenom,$mail,$password);
            if($_FILES['pfp']['tmp_name'] !=""){
            //stocker le contenu du formulaire
            $destination = "../Public/asset/image/";
            $bdd = new BddConnect;
            $bdd=$bdd->connexion();
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                echo 'e-mail non valide';
                exit;
            } else {
                $inscrit->insertUser($bdd);
                if($_FILES['pfp']['tmp_name'] !=""){
                move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                echo "le fichier à bien été importé et le compte crée<br>";
                $inscrit->activeUser($bdd);
            } 
        }
        }else{
            // boucle d'image manquante
            $_FILES['pfp']['tmp_name'] = ".../Public/asset/image/blank-profile-picture-973460_960_720-1.png";
            $destination = "../Public/asset/image/";
            $stmt = $bdd->prepare("SELECT FROM utilisateur WHERE mail_utilisateur=?");
            $stmt->execute([$mail]); 
            $user = $stmt->fetch();
            if ($user) {
                echo 'e-mail non valide';
                exit;
            } else {
                $inscrit->insertUser($bdd);
                if($_FILES['pfp']['tmp_name'] !=""){
                move_uploaded_file($_FILES['pfp']['tmp_name'],$destination.$_FILES['pfp']['name']);
                echo "le fichier à bien été importé et le compte crée";
                $inscrit->activeUser($bdd);
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

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlentities($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
?>