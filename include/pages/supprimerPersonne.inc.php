
	<h1>Supprimer des personnes enregistrées</h1>
	<?php
	    $pdo=new Mypdo();
	    $personneManager = new PersonneManager($pdo);
			$etudiantManager = new etudiantManager($pdo);
			$salarieManager = new salarieManager($pdo);
	    $personnes=$personneManager->getlistPersonne();

	if(empty($_GET['perNum'])){ ?>
		<table>
 			 <tr>
 					 <th>Nom</th>
 					 <th>Prénom</th>
 					 <th>Supprimer</th>
 			 </tr>
 			 <?php
 			 foreach ($personnes as $personne){ ?>
 					 <tr><td><?php echo $personne->getPerNom();?></a>
 					 </td><td><?php echo $personne->getPerPrenom();?></td>
 				 	 </td><td> <a href=index.php?page=4&perNum=<?php echo $personne->getPerNum();?>><img class="icone" src="image/erreur.png"  alt="Supprimer"/></a>
 					 </td></tr>
				<?php } ?>
		</table>
	<?php
 }
 else{?>
	 <p><img class="icone" src="image/valid.png"  alt="Valide"/> La personne <?php echo $personneManager->getNomPrenom($_GET["perNum"]) ?> a été supprimé</p>
	 <?php
	 $pernum=$_GET['perNum'];
	 $personneManager->delete_personne($pernum);
 }?>
