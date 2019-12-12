<?php
class Ville
{
	private $vil_num;
  private $vil_nom;

  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'vil_num' : $this->setVilNum($valeur); break;
        case 'vil_nom' : $this->setVilNom($valeur); break;
      }
    }
  }

    /**
     * Get the value of Vil Num
     *
     * @return mixed
     */
    public function getVilNum()
    {
        return $this->vil_num;
    }

    /**
     * Set the value of Vil Num
     *
     * @param mixed vil_num
     *
     * @return self
     */
    public function setVilNum($vil_num)
    {
        $this->vil_num = $vil_num;

        return $this;
    }

    /**
     * Get the value of Vil Nom
     *
     * @return mixed
     */
    public function getVilNom()
    {
        return $this->vil_nom;
    }

    /**
     * Set the value of Vil Nom
     *
     * @param mixed vil_nom
     *
     * @return self
     */
    public function setVilNom($vil_nom)
    {
        $this->vil_nom = $vil_nom;

        return $this;
    }

}
?>
