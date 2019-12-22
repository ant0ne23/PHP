<?php
$db=new Mypdo();
$personneManager = new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager = new SalarieManager($db);
$divisionManager=new DivisionManager($db);
$departementManager=new DepartementManager($db);
$fonctionManager=new FonctionManager($db);

$personnes=$personneManager->getlistPersonne();

	 if(empty($_GET['perNum']) && empty($_POST['bouton']) && empty($_SESSION['categorie'])){ ?>
		<h1>Modifier une personne enregistrée</h1>
		<table>
 			 <tr>
 		 		<th>Nom</th>
 		 	 	<th>Prénom</th>
 		 	 	<th>Modifier</th>
 			 </tr>
 			 <?php
 			 foreach ($personnes as $personne){ ?>
				 <tr><td><?php echo $personne->getPerNom();?></a>
				 </td><td><?php echo $personne->getPerPrenom();?></td>
				 </td><td> <a href=index.php?page=3&perNum=<?php echo $personne->getPerNum();?>><img class="icone" src="image/modifier.png"  alt="Supprimer"/></a>
 				 </td></tr>
				<?php } ?>
		</table>
	<?php
 }
 else if(empty($_GET['bouton']) && empty($_SESSION['categorie']) && isset($_GET['perNum'])){
	 $_SESSION['perNum']=$_GET['perNum'];?>
	 <h1>Modifier la personne <?php $personneManager->getNomPrenom($_SESSION['perNum']) ?></h1>
	 <form method="post" action="index.php?page=3">
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
	 <input type="submit" name="bouton">
	 </br>
 </form>
 <?php
 }
 if(isset($_POST['categorie'])){
	 $_SESSION['categorie'] = $_POST['categorie'];
   $_SESSION['personne'] = serialize(new Personne(array (
   'per_nom' => $_POST['nom'],
   'per_prenom' => $_POST['prenom'],
   'per_tel' => $_POST['tel'],
   'per_mail' => $_POST['mail'],
   'per_login' => $_POST['login'],
   'per_pwd' => $_POST['mdp'])));
	 if($_POST['categorie'=="etudiant"]){
		 $departement=$departementManager->getlist();
		 $division=$divisionManager->getlist();
		 ?>
		 <h1>Modifier un étudiant</h1>
		 <form method="post" action="index.php?page=3">
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
	if ($_GET['categorie']=="personnel")
	{
		 $fonction=$fonctionManager->getlist();
		 ?>
		 <h1>Modifier un Salarie</h1>
		 <form method="post" action="index.php?page=3">
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
if(isset($_SESSION['categorie'])){
 if($_SESSION['categorie']=="personnel"){
	 $personneModifiee=unserialize($_SESSION['personne']);
	 if($personneManager.isSalarie($personneModifiee->getPerNum())){
		 $newSal= new Salarie();
		 $newSal->setPerNum($personneModifiee->getPerNum());
		 $newSal->setTelProf($_POST['tel']);
		 $newSal->setFon($_POST['fonction']);
		 $salarieManager->updateSalariePourSalarie($newSal);
	 }
	 else{
		 $newSal=new Salarie();
		 $newSal->setPerNum($personneModifiee->getPerNum());
		 $newSal->setFon($_POST['fonction']);
		 $newSal->setTelProf($_POST['tel']);
		 $oldEtu= new Etudiant();
		 $oldEtu->setPerNum($personneModifiee->getPerNum());
		 $etudiantManager->deleteEtu($oldEtu);
		 $etudiantManager->updateEtudiantPourSalarie();
	 }
 }
 if($_SESSION['categorie']=="etudiant"){
	 $personneModifiee=unserialize($_SESSION['personne']);
	 if($personneManager.isSalarie($personneModifiee->getPerNum())){
		 $newEtu=new Etudiant();
		 $newEtu->setPerNum($personneModifiee->getPerNum());
		 $newEtu->setDiv($_POST['departement']);
		 $newEtu->setDep($_POST['division']);
		 $oldSal= new Salarie();
		 $oldSal->setPerNum($personneModifiee->getPerNum());
		 $salarieManager->deleteSal($oldSal);
		 $etudiantManager->updateSalariePourEtudiant();
	 }
	 else{
		 $newEtu= new Etudiant();
		 $newEtu->setPerNum($personneModifiee->getPerNum());
		 $newEtu->setDep($_POST['division']);
		 $newEtu->setDiv($_POST['division']);
		 $etudiantManager->updateEtudiantPourEtudiant($newSal);
	 }
}
}
