<?php

class DivisionManager
{

  private $dbo;
      public function __construct($db){
          $this->db = $db;
      }

    public function getlist()
    {
      $listeDivision = array();

      $sql = 'select * from division';
      $resu=$this->db->prepare($sql);
      $resu->execute();

      while($division = $resu->fetch(PDO::FETCH_OBJ))
      {
        $listeDivision[] = new Division($division);
      }
      $resu->closeCursor();
      return $listeDivision;


    }
}
 ?>
