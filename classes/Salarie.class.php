<?php
class Salarie extends Personne
{
  protected $per_num;
  private $sal_telprof;
  private $sal_fon;

  public function __construct ($valeur=array()){
    if (!empty($valeur)){
      parent::affecte($valeur);
      $this->affecteSal($valeur);
    }
  }

  public function affecteSal($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'per_num' : $this->setPerNum($valeur); break;
        case 'sal_telprof' : $this->setTelProf($valeur);
        case 'fon_libelle' : $this->setFon($valeur);
      }
    }
  }

  public function setTelProf($sal_telprof){
    $this->sal_telprof=$sal_telprof;
  }

  public function setFon($sal_fon){
    $this->sal_fon=$sal_fon;
  }

  public function getTelProf(){
    return $this->sal_telprof;
  }

  public function getFon(){
    return $this->sal_fon;
  }

  public function getPerNum(){
		return $this->per_num;
	}

	public function setPerNum($per_num){
		$this->per_num=$per_num;
	}

}
 ?>
