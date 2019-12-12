<?php
class Etudiant extends PERSONNE
{
	protected $per_num;
	private $etu_dep;
	private $vil_nom;
	private $div_nom;

	public function __construct ($valeur=array()){

		if (!empty($valeur))

			parent::__construct($valeur);
			$this->affecteEtu($valeur);
	}

	public function affecteEtu($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'per_num' : $this->setPerNum($valeur); break;
				case 'dep_nom' : $this->setDep($valeur); break;
				case 'vil_nom' : $this->setPerNum($valeur); break;
				case 'div_nom' : $this->setDiv($valeur); break;
			}
		}
	}

	public function getPerNum(){
		return $this->per_num;
	}

	public function setPerNum($per_num){
		$this->per_num=$per_num;
	}
	public function getDiv(){
		return $this->div_nom;
	}

	public function setDiv($division){
		$this->div_nom=$division;
	}
	public function setPrenom($Prenom){
		$this->etu_Pre=$Prenom;
	}
	public function setMail($mail){
		$this->etu_mail=$mail;
	}
	public function setTel($tel){
		$this->etu_tel=$tel
		;
	}
	public function setDep($dep){
		$this->etu_dep=$dep
		;
	}

	public function getPrenom(){
		return $this->etu_Pre;
	}
	public function getMail(){
		return $this->etu_mail;
	}

	public function getTel(){
		return $this->etu_tel;
	}

	public function getDep(){
		return $this->etu_dep;
	}



}
?>
