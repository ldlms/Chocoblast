<?php

class Commentaire{
    private ?int $id;
    private ?int $note;
    private ?string $texte;
    private ?string $date;
    private ?bool $statut;
    private ?Utilisateur $cible;
    private ?Utilisateur $commentaire;

    public function __construct($note,$texte,$date,$statut,$cible,$commentaire){
        $this->note = $note;
        $this->texte = $texte;
        $this->date = $date;
        $this->statut = $statut;
        $this->cible = $cible;
        $this->commentaire = $commentaire;
    }

    public function getId(){
        return $this->id;
    }
    public function getNote(){
        return $this->note;
    }
    public function getDate(){
        return $this->date;
    }
    public function getTexte(){
        return $this->texte;
    }
    public function getCible(){
        return $this->cible;
    }
    public function getCommentaire(){
        return $this->commentaire;
    }
    public function getStatut(){
        return $this->statut;
    }


    public function setNote($note){
        $this->note = $note;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setTexte($texte){
        $this->texte = $texte;
    }
    public function setCommentaire($commentaire){
        $this->commentaire = $commentaire;
    }
    public function setCible($cible){
        $this->cible = $cible;
    }
    public function setStatut($statut){
        $this->statut = $statut;
    }
}

?>