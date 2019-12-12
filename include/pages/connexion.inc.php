<h1>Pour vous connecter</h1>
<?php
if(empty($login) or empty($pwd)){
 ?>
<form name="connexion" method="POST">
  Login : <input type="text" id="login" name="login"><br />
  Mot de Passe : <input type="password" id="pwd" name="password"><br />
  <?php
  $nb1=rand(1,9);
  $nb2=rand(1,9);
  $somme=$nb1+$nb2;?>
  <img src="image/nb/<?php echo $nb1; ?>.jpg"> + <img src="image/nb/<?php echo $nb2; ?>.jpg"> = <input type="text" id="code" name="code">
  <br />
  <input type="submit" value="Valider">
</form>
<?php
}
else{
  $login=$_POST["login"];
  $mdp=$_POST["pwd"];
}
?>
