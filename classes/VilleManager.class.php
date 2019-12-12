<?php
class VilleManager{
  public function __construct($db){
    $this->db = $db;
  }

  public function getListVille(){
    $listeVilles = array();

    $sql = 'select vil_num, vil_nom FROM ville';

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($ville = $requete->fetch(PDO::FETCH_OBJ))
      $listeVilles[] = new Ville($ville);
    $requete-> closeCursor();
    return $listeVilles;
  }

  public function ajoutVille($nom_ville){
      $sql = "INSERT INTO VILLE(vil_nom) VALUES('$nom_ville')";

      $requete = $this->db->prepare($sql);
      $requete->execute();
  }
}
?>
