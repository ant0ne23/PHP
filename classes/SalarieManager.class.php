<?php
class SalarieManager{
  public function __construct($db){
    $this->db=$db;
  }

  public function detailSalarie($perNum){
    $sql = 'SELECT p.per_nom, p.per_prenom, p.per_mail, p.per_tel, s.sal_telprof, f.fon_libelle FROM PERSONNE p JOIN SALARIE s ON p.per_num = s.per_num JOIN FONCTION f ON s.fon_num = f.fon_num  WHERE p.per_num ='.$perNum;

    $requete=$this->db->prepare($sql);
    $requete->execute();

    $detailSal = $requete->fetch(PDO::FETCH_OBJ);
    $sal = new Salarie($detailSal);
    $requete->closeCursor();

    return $sal;
  }

  public function addSalarie($salarie)
{
  $req = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num)');
  $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
  $req->bindValue(':sal_telprof',$salarie->getTelProf(),PDO::PARAM_STR);
  $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);
  $retour=$req->execute();
  return $retour;
}

public function updateSalariePourSalarie($salarie){
  $req = $this->db->prepare('UPDATE `salarie` SET `sal_telprof` = :sal_telprof, `fon_num` = :fon_num WHERE `salarie`.`per_num` = :per_num');
  $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
  $req->bindValue(':sal_telprof',$salarie->getTelProf(),PDO::PARAM_STR);
  $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);

  $retour=$req->execute();
}

public function updateEtudiantPourSalarie($salarie){
  $req = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num)');
  $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
  $req->bindValue(':sal_telprof',$salarie->getTelProf(),PDO::PARAM_STR);
  $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);
  $retour=$req->execute();
}

public function suppEtu($salarie){
  $req = $this->db->prepare('DELETE FROM `etudiant` WHERE `etudiant`.`per_num` = :per_num');
  $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
  $retour=$req->execute();
}
}
?>
