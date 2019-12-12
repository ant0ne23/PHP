
	<h1>Supprimer des personnes enregistrées</h1>
	<?php
	    $pdo=new Mypdo();
	    $personneManager = new PersonneManager($pdo);
	    $personnes=$personneManager->getlistPersonne();
	?>
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
	            <td><a href=""><img src="image/erreur.png" alt="supprimer" id="image_erreur"/></a></td>
	            </tr>
	        <?php } ?>
	    </table>
