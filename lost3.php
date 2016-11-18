<?php
$titrePage = "Bioforce3 - Réinitialisation mot de passe";
include "includes/entete.php";
// la valeur du token envoyé par mail se trouve dans l'url
// donc dans le tableau $_GET
$token = htmlentities(strip_tags($_GET['token']));

$rq = "SELECT idClient 
	   FROM clients
	   WHERE token = ?";
// préparation
$stmt = $bdd->prepare($rq);
// exécution
$stmt->execute(array($token));
// récupération
$idClient = $stmt->fetchColumn();
if($idClient >= 1)
{
	// affichage d'un formulaire
	echo '<form method="post" action="lost4.php">
			<input type="hidden" name="idClient" value="'.$idClient.'" />
			<div class="form-group">
			  <label for="mdp1">Mot de passe</label>
			  <input type="password" id="mdp1" name="pass" class="form-control" 
			  		 required />
			</div>
			<div class="form-group">
			  <label for="mdp2">Confirmez votre mot de passe</label>
			  <input type="password" id="mdp2" name="pass2" class="form-control" 
			  		 required />
			</div>
			<div class="form-group text-center">
			  <input type="submit" name="btnSub" value="Enregistrer"
			  		 class="btn btn-lg btn-success" />
			</div>
		  </form>';
}
else echo 'Désolé, Je ne vous connais pas!';

include "includes/piedPage.php";
?>