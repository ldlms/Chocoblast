<?php
include './App/utils/connectBdd.php';
include './App/utils/function.php';
include './App/model/utilisateur.php';
include './App/manager/managerUtilisateur.php';
include './App/API/ApiUtilisateur.php';

// On instance l'API
$api = new ApiUtilisateur();

//Analyse de l'URL avec parse_url() et retourne ses composants
$url = parse_url($_SERVER['REQUEST_URI']);
//test soit l'url a une route sinon on renvoi à la racine
$path = isset($url['path']) ? $url['path'] : '/';
/*--------------------------ROUTER -----------------------------*/
//test de la valeur $path dans l'URL et import de la ressource
switch($path){
//route /projet/test -> ./test.php
case $path === "/choco/inscription" :
include './App/controler/controleraddUser.php';
break ;
//route /projet/addUser -> ./controler/controler_add_user.php
case $path === "/choco/connexion":
include './App/controler/controlerConnectUser.php';
break ;
case $path === "/choco/deco";
include './App/controler/controlerDeconection.php';
break;
case $path === '/choco/':
    include './App/controler/controlerAcceuil.php';
// ET LA ON BALANCE LES DIFFERENTS CONTROLLEURS
}
?>

