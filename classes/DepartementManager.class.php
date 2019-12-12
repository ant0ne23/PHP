<?php

class DepartementManager
{

  private $dbo;
      public function __construct($db){
          $this->db = $db;
      }

    public function getlist()
    {
      $listeDepartement = array();

      $sql = 'select * from departement';
      $resu=$this->db->prepare($sql);
      $resu->execute();

      while($departement = $resu->fetch(PDO::FETCH_OBJ))
      {
        $listeDepartement[] = new Departement($departement);
      }
      $resu->closeCursor();
      return $listeDepartement;


    }
}
 ?>
