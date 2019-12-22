<h1>Modifier une Ville</h1>

  <?php

  $db = new Mypdo;
  $villeManager = new VilleManager($db);
	$villes = $villeManager->getListVille();

	if(empty($_GET["vilNum"]) && empty($_POST["vilNom"])){
		?>
	 <p>Actuellement <?php count($villes)?> villes enregistrées</p>

   <table>
     <tr>
       <th>Numéro</th>
       <th>Nom</th>
       <th>Modifier</th>
     </tr>
     <?php
     foreach ($villes as $villes){ ?>
     <tr><td><?php echo $villes->getVilNum();?>
     </td><td><?php echo $villes->getVilNom();?>
     </td><td><a  href="index.php?page=11&vilNum=<?php echo $villes->getVilNum();?>"> <img class="icone" src="image/modifier.png"  alt="Modifier"/></a>

     </td></tr>
   <?php } ?>
 </table>

<?php } else if (!empty($_GET["vilNum"]) && empty($_POST["vilNom"])){
	$villeModif = $villeManager->getVilleWithNum($_GET['vilNum']);
	?>

	<form name="FormulaireVille" id="formulaireVille" action="#" method="post">
			<label id=nom> Nom : </label><input type="text" size=30 maxlength=50 name="vilNom" value=<?php echo $villeModif ?> required>
	<br />
			<input type=submit value="Modifier">
	</form>
	<?php
} else {
	$vilModif = new Ville(
    array(
			'vil_num' => $_GET["vilNum"],
			'vil_nom' => $_POST["vilNom"]
		)
  );
	?>
	<p><img class="icone" src="image/valid.png"  alt="Valide"/> La ville <?php echo $vilModif->getVilNom(); ?> a été modifiée</p>
	<p>Redirection ...</p>
<?php
$villeManager->updateVille($vilModif);
header ("Refresh: 2;URL=index.php?page=11");
 }?>
