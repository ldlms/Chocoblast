<!-- partie affichage HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./App/Public/asset/style/main.css">
    <script src="./App/Public/asset/script/script.js" defer></script>
    <title>Inscription</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>Veuillez saisir le nom</p>
        <input type="text" name="nom">
        <p>Veuillez saisir le prenom</p>
        <input type="text" name="prenom">
        <p>Veuillez saisir votre mail</p>
        <input type="text" name="mail">
        <p>Un mot de passe</p>
        <input type="password" name="password">
        <p>Et une image de profil</p>
        <input type="file" name="pfp">
        <input type="submit" name="submit" value="envoyer">
    </form>
    <div><?php echo $message ?></div>
    <div><a href="connexion">connexion</a></div>
    <br>
    <div><a href="/choco/">Retour à l'acceuil</a></div>
    <br>
    <div><a href="deco">Deconnection</a></div>
</body>
</html>