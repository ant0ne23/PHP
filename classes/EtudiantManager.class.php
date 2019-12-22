<?php
class EtudiantManager{
  public function __construct($db){
    $this->db=$db;
  }

  public function detailEtu($perNum){
    $sql = 'SELECT p.per_nom, p.per_prenom, p.per_mail, p.per_tel, d.dep_nom, v.vil_nom FROM PERSONNE p JOIN ETUDIANT e ON p.per_num = e.per_num JOIN DEPARTEMENT d ON e.dep_num = d.dep_num JOIN VILLE v ON d.vil_num = v.vil_num  WHERE p.per_num ='.$perNum;
    print_r($sql);
    $requete = $this->db->prepare($sql);
    $requete->execute();


    $detailEtu = $requete->fetch(PDO::FETCH_OBJ);
    $etu = new Etudiant($detailEtu);
    $requete->closeCursor();

    return $etu;
  }

  public function get_liste_departement(){
      $sql = "SELECT dep_nom FROM DEPARTEMENT";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($dep_nom = $requete->fetch(PDO::FETCH_OBJ))
              $listedepartements[] = new Etudiant($dep_nom);

      $requete->closeCursor();
      return $listedepartements;
  }

  public function get_liste_annees(){
      $sql = "SELECT div_nom FROM division";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($div_nom = $requete->fetch(PDO::FETCH_OBJ))
              $listedivision[] = new Etudiant($div_nom);

      $requete->closeCursor();
      return $listedivision;
  }

  public function addEtudiant($etudiant)
  {
    $req = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num)');
    $req->bindValue(':per_num',$etudiant->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':dep_num',$etudiant->getDep(),PDO::PARAM_INT);
    $req->bindValue(':div_num',$etudiant->getDiv(),PDO::PARAM_INT);
    $retour=$req->execute();
    return $retour;
  }

  public function updateEtudiantPourEtudiant($etudiant){
    $req = $this->db->prepare('UPDATE `etudiant` SET `dep_num` = :dep_num, `div_num` = :div_num WHERE `etudiant`.`per_num` = :num');
    $req->bindValue(':num',$etudiant->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':dep_num',$etudiant->getDepNum(),PDO::PARAM_INT);
    $req->bindValue(':div_num',$etudiant->getDivNum(),PDO::PARAM_INT);
    $retour=$req->execute();
  }

  public function updateSalariePourEtudiant($etudiant){
    $req = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num)');
    $req->bindValue(':per_num',$etudiant->getPerNum(),PDO::PARAM_STR);
    $req->bindValue(':dep_num',$etudiant->getDep(),PDO::PARAM_STR);
    $req->bindValue(':div_num',$etudiant->getDiv(),PDO::PARAM_STR);
    $retour=$req->execute();
  }

  public function deleteEtu($salarie){
    $req = $this->db->prepare('DELETE FROM `etudiant` WHERE `etudiant`.`per_num` = :per_num');
    $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
    $retour=$req->execute();
  }
}
 ?>
