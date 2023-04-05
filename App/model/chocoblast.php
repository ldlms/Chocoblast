<?php
    class Chocoblast{
        private ?int $id;
        private ?string $slogan;
        private ?string $date;
        private ?bool $statut;
        private ?Utilisateur $cible;
        private ?Utilisateur $auteur;
        
        public function __construct($slogan,$date,$statut,$cible,$auteur){
            $this->slogan = $slogan;
            $this->date = $date;
            $this->statut = $statut;
            $this->cible = $cible;
            $this->auteur = $auteur;
        }

        public function getId(){
            return $this->id;
        }
        public function getSlogan(){
            return $this->slogan;
        }
        public function getDate(){
            return $this->date;
        }
        public function getStatut(){
            return $this->statut;
        }
        public function getCible(){
            return $this->cible;
        }
        public function getAuteur(){
            return $this->auteur;
        }


        public function setSlogan($slogan){
            $this->slogan = $slogan;
        }
        public function setDate($date){
            $this->date = $date;
        }
        public function setStatut($statut){
            $this->statut = $statut;
        }
        public function setCible($cible){
            $this->cible = $cible;
        }
        public function setAuteur($auteur){
            $this->auteur = $auteur;
        }

        public function addChocoblast($bdd){

        }

        public function validateChocoblast($bdd,bool $bool){

        }

        public function showChocoblast($bdd){
            return 'Chocoblast';
        }

        public function showAllChocoblast($bdd){
            return 'allChocoblast';
        }

        public function showTopChocoblast($bdd,int $value): ?array{
            return [];
        }
    }

?>