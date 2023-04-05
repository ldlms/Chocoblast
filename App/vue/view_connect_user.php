<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./App/Public/asset/style/main.css">
    <script src="./App/Public/asset/script/script.js" defer></script>
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <input type="password" name="password" placeholder="mot de passe">
        <input type="mail" name="mail" placeholder="mail">
        <input type="submit" name="submit" value="Connexion">
    </form>
   <?php echo $message ?>
   <div><a href="inscription">inscription</a></div>
   <br>
   <div><a href="/choco/">Retour à l'acceuil</a></div>
   <br>
   <div><a href="deco">Deconnection</a></div>
</body>
</html>
