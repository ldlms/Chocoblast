<?php

include './App/model/utilisateur.php';
include './App/manager/managerUtilisateur.php';

class ApiUtilisateur extends Utilisateur{
    public function insertUser(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Content-Type: application/json');
        echo json_encode(['erreur : '=>'Bienvenue sur Chocoblast']);
    }

}

?>