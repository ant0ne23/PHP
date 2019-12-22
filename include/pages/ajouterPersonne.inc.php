<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager=new SalarieManager($db);
$divisionManager=new DivisionManager($db);
$departementManager=new DepartementManager($db);
$fonctionManager=new FonctionManager($db);

if(empty($_POST['categorie']) && empty($_POST['bouton'])){
 ?>
<h1>Ajouter une personne</h1>
<form method="post" action="index.php?page=1">
<label for="nom">Nom :</label>
<input type="texte" required="required" id="nom" name="nom" size="15">
</br>
<label for="prenom">Prenom :</label>
<input type="texte" required="required" id="prenom" name="prenom" size="15">
</br>
<label for="tel">Telephone :</label>
<input type="texte" required="required" id="tel" name="tel" size="15">
</br>
<label for="mail">Mail :</label>
<input type="texte" required="required" id="mail" name="mail" size="15">
</br>
<label for="login">Login :</label>
<input type="texte" required="required" id="login" name="login" size="15">
</br>
<label for="mdp">Mot de Passe :</label>
<input type="password" required="required" id="mdp" name="mdp" size="15">
</br>
<label for="categorie">Catégorie</label>
<input type="radio" name="categorie" value="etudiant">Etudiant
<input type="radio" name="categorie" value="personnel">Personnel
</br>
<input type="submit" name="submit">
</br>
</form>

<?php
}
else {
  if(isset($_POST['categorie'])){
      $_SESSION['personne'] = serialize(new Personne(array (
      'per_nom' => $_POST['nom'],
      'per_prenom' => $_POST['prenom'],
      'per_tel' => $_POST['tel'],
      'per_mail' => $_POST['mail'],
      'per_login' => $_POST['login'],
      'per_pwd' => $_POST['mdp'])));
    if ($_POST['categorie']=="etudiant")
    {
        $departement=$departementManager->getlist();
        $division=$divisionManager->getlist();
        ?>
				<h1>Ajouter un Etudiant</h1>
				<form method="post" action="index.php?page=1">
					<label for="departement">Departement :</label>
					<SELECT name="departement" size="1">
            <?php
            foreach ($departement as $dep) {
              ?><OPTION value=<?php echo $dep->getDepNum() ?>><?php echo $dep->getDepNom();
            }
             ?>
					</SELECT></br>
					<label for="division">Division :</label>
					<SELECT name="division" size="1">
            <?php
            foreach ($division as $div) {
              ?><OPTION value=<?php echo $div->getDivNum()?>><?php echo $div->getDivNom();
            }
             ?>
					</SELECT>
          <input type="submit" name="bouton">
				</form>
				<?php
    }
    if ($_POST['categorie']=="personnel")
    {
        $fonction=$fonctionManager->getlist();
				?>
				<h1>Ajouter un Salarie</h1>
        <form method="post" action="index.php?page=1">
  				<label for="tel">Telephone professionnel :</label>
  				<input type="texte" required="required" id="tel" name="tel" size="15">
  				</br>
  				<label for="fonction">Fonction</label>
  				<SELECT name="fonction" size="1">
            <?php
            foreach ($fonction as $fon) {
              ?><OPTION value=<?php echo $fon->getFonNum()?>><?php echo $fon->getFonLibelle();
            }
             ?>
  				</SELECT>
          </br>
          <input type="submit" name="bouton">
        </form>
				<?php
    }
  }
    else{
      if(isset($_POST["fonction"])){
        $personneajoutee=unserialize($_SESSION['personne']);
        $personneManager->addPersonne($personneajoutee);
        $newSal= new Salarie();
        $newSal->setPerNum($personneManager->lastInsertId());
        $newSal->setTelProf($_POST['tel']);
        $newSal->setFon($_POST['fonction']);
        $salarieManager->addSalarie($newSal);
        ?> <p><?php echo "Le salarie ".$personneManager->getNomPrenom($personneManager->lastInsertId())."a bien été ajouté"?></p><?php
      }
      if(isset($_POST["division"])){
        $personneajoutee=unserialize($_SESSION['personne']);
        $personneManager->addPersonne($personneajoutee);
        $newEtu= new Etudiant();
        $newEtu->setPerNum($personneManager->lastInsertId());
        $newEtu->setDiv($_POST['division']);
        $newEtu->setDep($_POST['departement']);
        $etudiantManager->addEtudiant($newEtu); ?>
        <p><?php echo "L'étudiant' ".$personneManager->getNomPrenom($personneManager->lastInsertId())."a bien été ajouté"?></p><?php
      }
    }
}
 ?>
