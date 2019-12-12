<?php
class Fonction
{
  private $fon_num;
  private $fon_libelle;

  public function __construct($valeur=array()){
    if(!empty($valeur)){
      $this->affecteFon($valeur);
    }
  }

  public function affecteFon($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'fon_num':$this->setFonNum($valeur);
        case 'fon_libelle':$this->setFonLibelle($valeur);
      }
    }
  }

  public function setFonNum($valeur){
    $this->fon_num=$valeur;
  }

  public function setFonLibelle($valeur){
    $this->fon_libelle=$valeur;
  }

  public function getFonNum(){
    return $this->fon_num;
  }

  public function getFonLibelle(){
    return $this->fon_libelle;
  }
}
 ?>
