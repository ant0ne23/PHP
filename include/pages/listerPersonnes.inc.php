<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager=new SalarieManager($db);
$personnes=$personneManager->getlistPersonne();
$nombrePersonnes = count($personnes);

if(empty($_GET['PerNum'])){
 ?>
	<h1>Liste des personnes enregistrées</h1>
  <?php
    $listePersonne = $personneManager -> getlistPersonne();
    echo "<p>Actuellement ".count($listePersonne)." personnes enregistrées</p>";
   ?>
	<table>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prénom</th>
		</tr>
		<?php
			foreach($listePersonne as $personne)
			{?>
				<tr>
					<td><a href="index.php?page=2&PerNum=<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNum();?></a></td>
					<td><?php echo $personne->getPerNom(); ?> </td>
					<td><?php echo $personne->getPerPrenom(); ?> </td>
			<?php } ?>
		</table>
  <?php
  }
else{
  $pernum=$_GET['PerNum'];
  if ($personneManager->isSalarie($pernum)){
    $salarie=$salarieManager->detailSalarie($pernum);
	?>
				<h1><?php echo "Détails sur le salarie ".$salarie->getPerNom()?></h1>
        <table>
  				<tr>
  					<th>Prénom</th>
  					<th>Mail</th>
  					<th>Tel</th>
  					<th>Tel pro</th>
  					<th>Fonction</th>
  				</tr>
          <tr>
    				<td><?php echo $salarie->getPerPrenom();?></td>
    				<td><?php echo $salarie->getPerMail();?></td>
    				<td><?php echo $salarie->getPerTel();?></td>
    				<td><?php echo $salarie->getTelProf();?></td>
    				<td><?php echo $salarie->getFon();?></td>
    			</tr>
        </table>
	<?php
	} else {
  		$etudiant=$etudiantManager->detailEtu($pernum);
  		 ?>
			<h1><?php echo "Détails sur l'étudiant ".$etudiant->getPerNom()?></h1>

			<table>
				<tr>
					<th>Prénom</th>
					<th>Mail</th>
					<th>Tel</th>
					<th>Département</th>
					<th>Ville</th>
				</tr>

			<tr>
				<td><?php echo $etudiant->getPerPrenom();?></td>
				<td><?php echo $etudiant->getPerMail();?></td>
				<td><?php echo $etudiant->getPerTel();?></td>
				<td><?php echo $etudiant->getDep();?></td>
				<td><?php echo $etudiant->getVille();?></td>
			</tr>
		</table>
		<?php
  }
}
?>
