<h1>Supprimer une Ville</h1>

<?php $db = new Mypdo;
      $ville = new VilleManager($db);
      $villes = $ville->getListVille();

if(empty($_GET["vilNum"])){
  ?>
 Actuellement <?php count($villes)?> villes enregistrées

 <table>
   <tr>
     <th>Numéro</th>
     <th>Nom</th>
     <th>Supprimer</th>
   </tr>
   <?php
   foreach ($villes as $villes){ ?>
   <tr>
     <td><?php echo $villes->getVilNum();?></td>
     <td><?php echo $villes->getVilNom();?></td>
     <td><a  href="index.php?page=12&vilNum=<?php echo $villes->getVilNum();?>"> <img class="icone" src="image/erreur.png"  alt="Supprimer"/></a></td>
   </tr>
   <?php } ?>
 </table>

<?php
} else  {
  $nomVille = $ville->getVilleWithNum($_GET["vilNum"]);

  $dep=$ville->getFirstDepartementFromVille($_GET["vilNum"]);
  if(null!=$dep){
    ?>
    <p><img class="icone" src="image/erreur.png"  alt="Erreur"/> Erreur, vous ne pouvez pas supprimer une ville liée à un ou plusieurs départements</p>
    <p>Redirection ...</p><?php

  }
  else{ ?>
    <p><img class="icone" src="image/valid.png"  alt="Valide"/> La ville <?php echo $nomVille ?> a été supprimé</p>
    <p>Redirection ...</p><?php
    $ville->deleteVille($_GET["vilNum"]);

  }
  header ("Refresh: 2;URL=index.php?page=12");

}?>
