<?php

class Division
{
  //valeur

    private $div_num;
    private $div_nom;
  //Constructeur
  public function __construct($valeurs = array()){
      if (!empty($valeurs))
               $this->affecte($valeurs);
  }

  //methode

  public function affecte($donnees)
  {
    foreach($donnees as $attribut => $valeur)
    {
     switch ($attribut)
     {
       case 'div_num' : $this->setDivNum($valeur); break;
       case 'div_nom' : $this->setDivNom($valeur); break;
     }
    }
   }

   //Get/set

   public function getDivNom(){
     return $this->div_nom;
   }
   public function setDivNom($id){
     $this->div_nom=$id;
   }
   public function getDivNum(){
     return $this->div_num;
   }
   public function setDivNum($id){
     $this->div_num=$id;
   }

}





 ?>
