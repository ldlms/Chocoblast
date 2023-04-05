<?php

    class ManagerUtilisateur extends Utilisateur{

        public function getUserByMail(){
            try{
            $mail = $this->getMail();
            $bdd = BddConnect::connexion();
            $req = $bdd->prepare("SELECT nom_utilisateur,prenom_utilisateur,mail_utilisateur,password_utilisateur FROM utilisateur WHERE mail_utilisateur=?");
            $req->bindParam(1,$mail, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            } catch (Exception $e){
                die('Error: '.$e->getMessage());
            }
        }

        public function insertUser(){
            $nom = $this->getNom();
            $prenom = $this->getPrenom();
            $mail = $this->getMail();
            $password = $this->getPassword();
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $image = $_FILES['pfp']['tmp_name'];
            $statut = $this->getStatut();
            $role = $this->getRole();  
            $bdd = BddConnect::connexion();
            try{
                $req2 = $bdd->prepare('INSERT INTO `utilisateur`(`nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `password_utilisateur`, `image_utilisateur`,`statut_utilisateur`,`id_roles`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $req2->bindParam(1, $nom, PDO::PARAM_STR);
                $req2->bindParam(2, $prenom, PDO::PARAM_STR);
                $req2->bindParam(3, $mail, PDO::PARAM_STR);
                $req2->bindParam(4, $hashed, PDO::PARAM_STR);
                $req2->bindParam(5, $image, PDO::PARAM_STR);
                $req2->bindParam(6, $statut, PDO::PARAM_STR);
                $req2->bindParam(7, $role, PDO::PARAM_STR);
                $req2->execute();
            }catch(Exception $e){
                die('Error: '.$e->getMessage("bof"));
            }
        }

        public function activeUser(){
            $nom = $this->getNom();
            $bdd = BddConnect::connexion();
            try{
                $req3 = $bdd->prepare("UPDATE utilisateur SET statut_utilisateur = 1 WHERE nom_utilisateur=?");
                $req3->execute([$nom]);
                echo "switch effectué";
            }catch(Exception $e){
                die('Error: '.$e->getMessage());
            }
        }
    }
?>