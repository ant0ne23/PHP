<?php

  class PersonneManager{
    public function __construct($db){
      $this->db=$db;
    }

    public function getlistPersonne(){
      $listePersonne = array();

      $sql = 'select per_num, per_nom, per_prenom FROM PERSONNE';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while($personne = $requete->fetch(PDO::FETCH_OBJ))
        $listePersonne[] = new Personne($personne);
        $requete->closeCursor();
        return $listePersonne;
    }

    public function isSalarie($perNum){
            $sql = 'SELECT * FROM SALARIE WHERE per_num ='.$perNum;
            $requete = $this->db->prepare($sql);
            $requete->execute();
            if ($result = $requete->fetch(PDO::FETCH_OBJ)){ //result retourne un booleen
                $requete->closeCursor();
                return $result;
            } else {
                $requete->closeCursor();
                return $result;
            }
    }

    public function addPersonne($personne){
        $sql = "INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail,per_admin,per_login,per_pwd) VALUES(:nom,:prenom,:tel,:mail,0,:login,:pwd_crypte)";

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':nom', $personne->getPerNom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $personne->getPerPrenom(), PDO::PARAM_STR);
        $requete->bindValue(':tel', $personne->getPerTel(), PDO::PARAM_STR);
        $requete->bindValue(':mail', $personne->getPerMail(), PDO::PARAM_STR);
        $requete->bindValue(':login', $personne->getLogin(), PDO::PARAM_STR);
        $requete->bindValue(':pwd_crypte', cryptePwd($personne->getPwd()), PDO::PARAM_STR);

        $requete->execute();
      }

      public function getNumPersonne($login){
          $sql = "SELECT per_num FROM PERSONNE WHERE per_login='$login'";

          $requete = $this->db->prepare($sql);
          $requete->execute();
    }

    public function lastInsertId() {
        $req = $this->db->query("select LAST_INSERT_ID()");
        $req->execute();
        $lastId = $req->fetchColumn();
        return $lastId;
      }
      
    public function delete_personne($pernum){
      $sql1 = "DELETE * FROM Personne WHERE per_num=".$pernum;
      $sql2 = "DELETE * FROM Vote WHERE per_num=".$pernum;
      $sql3 = "DELETE * FROM Etudiant WHERE per_num=".$pernum;
      $sql4 = "DELETE * FROM Salarie WHERE per_num=".$pernum;
      $sql5 = "DELETE * FROM Citation WHERE per_num=".$pernum;

      $requete1 = $this->db->prepare($sql1);
      $requete1->execute();
      $requete2 = $this->db->prepare($sql2);
      $requete2->execute();
      $requete3 = $this->db->prepare($sql3);
      $requete3->execute();
      $requete4 = $this->db->prepare($sql4);
      $requete4->execute();
      $requete5 = $this->db->prepare($sql5);
      $requete5->execute();
    }
}
 ?>
