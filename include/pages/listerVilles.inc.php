	<?php
	$db=new Mypdo();
	$manager= new VilleManager($db);
	?>
	<h1>Liste des villes</h1>
	<table>
		<tr>
			<th>Numero</th>
			<th>Nom</th>
		</tr>
		<?php
		$listeVilles = $manager -> getListVille();

		foreach($listeVilles as $ville)
		{ ?>
			<tr>
				<td><?php echo $ville->getVilNum(); ?> </td>
				<td><?php echo $ville->getVilNom(); ?> </td>
			</tr>
		<?php } ?>
	</table>
