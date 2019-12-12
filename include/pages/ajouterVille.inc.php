<h1>Ajouter une ville</h1>
  <?php
  if(empty($_POST['nom_ville'])) { ?>
  <form method="post" action="index.php?page=7">
    <label for="nom">Nom :</label>
    <input type="texte" id="nom_ville" name="nom_ville" size="15">
    </br>
    <input type="submit" value='Valider'>
  </form>

  <?php
}
  else {
  $nom_ville=$_POST['nom_ville'];
  ?>
  <img src="image/valid.png">
  <label style="font-weight : normal !important;">"la ville "<?php echo $nom_ville ?>" a bien été ajoutée"</label>
  <?php
  $pdo=new Mypdo();
  $villeManager = new VilleManager($pdo);
  $villeManager->ajoutVille($nom_ville);
}
  ?>
