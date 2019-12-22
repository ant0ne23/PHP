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

  public function getVilleWithNum($numVille){
			$sql = "select vil_nom FROM ville where vil_num=$numVille";
			$requete = $this->db->prepare($sql);
			$requete->execute();
			$ville = $requete->fetch(PDO::FETCH_OBJ);
			return $ville->vil_nom;
		}

    public function getFirstDepartementFromVille($numVille){
      $sql="select dep_num FROM departement WHERE vil_num=$numVille";
      $requete=$this->db->prepare($sql);
      $requete->execute();
      $dep = $requete->fetch(PDO::FETCH_OBJ);
      return $dep;
    }

  public function deleteVille($numVille){
			$sql = "delete from ville WHERE vil_num = $numVille";
			$requete = $this->db->prepare($sql);
			$requete->execute();
		}
  public function updateVille($ville){
			$sql = "Update ville set vil_nom = :vilNom WHERE vil_num = :vilNum";
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':vilNum', $ville->getVilNum(), PDO::PARAM_INT);
			$requete->bindValue(':vilNom', $ville->getVilNom(), PDO::PARAM_STR);
			$requete->execute();
		}
}
?>
