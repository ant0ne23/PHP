<?php
class Personne{
  protected $per_num;
  protected $per_nom;
  protected $per_prenom;
  protected $per_tel;
  protected $per_mail;
  protected $per_ville;
  protected $per_login;
  protected $per_pwd;

  public function __construct($valeurs=array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
	    foreach ($donnees as $attribut => $valeur){
	      switch ($attribut){
	      		case 'per_num': $this->setPerNum($valeur); break;
	          case 'per_nom': $this->setPerNom($valeur); break;
	          case 'per_prenom': $this->setPerPrenom($valeur); break;
	          case 'per_mail': $this->setPerMail($valeur); break;
	          case 'per_tel': $this->setPerTel($valeur); break;
						case 'vil_nom': $this->setVille($valeur);break;
            case 'per_login': $this->setLogin($valeur); break;
            case 'per_pwd': $this->setPwd($valeur); break;
	      }
	    }
		}

    public function setlogin($valeur){
      $this->per_login=$valeur;
      return $this;
    }

    public function getLogin(){
      return $this->per_login;
    }

    public function setPwd($valeur){
      $this->per_pwd=$valeur;
      return $this;
    }

    public function getPwd(){
      return $this->per_pwd;
    }

    public function getPerNum()
    {
        return $this->per_num;
    }

    public function setPerNum($per_num)
    {
        $this->per_num = $per_num;

        return $this;
    }

    public function getPerNom()
    {
        return $this->per_nom;
    }

    public function setPerNom($per_nom)
    {
        $this->per_nom = $per_nom;

        return $this;
    }

    public function getPerPrenom()
    {
        return $this->per_prenom;
    }

    public function setPerPrenom($per_prenom)
    {
        $this->per_prenom = $per_prenom;

        return $this;
    }

    public function setPerTel($per_tel)
    {
      $this->per_tel = $per_tel;
      return $this;
    }

    public function getPerTel()
    {
      return $this->per_tel;
    }

    public function setPerMail($per_mail)
    {
      $this->per_mail=$per_mail;
      return $this;
    }

    public function getPerMail()
    {
      return $this->per_mail;
    }

    public function setVille($ville){
      $this->per_ville=$ville
      ;
    }
    public function getVille(){
    return $this->per_ville;
  }

}
 ?>
