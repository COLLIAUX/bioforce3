<?php
/* ajout d'un nouveau client dans la table clients */

include "includes/connexion.php";

if(isset($_POST['btnSub']))
{
	//nettoyage
	$nom     = htmlentities(strip_tags($_POST['nom']));
	$prenom  = htmlentities(strip_tags($_POST['prenom']));
	$adresse = htmlentities(strip_tags($_POST['adresse']));
	$cp      = htmlentities(strip_tags($_POST['cp']));
	$ville   = htmlentities(strip_tags($_POST['ville']));
	$email   = htmlentities(strip_tags($_POST['email']));
	$mdp     = htmlentities(strip_tags($_POST['mdp']));

	//encodage du mot de passe
	$hash = password_hash($mdp, PASSWORD_DEFAULT);

	$rqAjout = "INSERT INTO clients(nomClient, prenomClient, adresseClient,
									cpClient, villeClient, emailClient, PassClient)
				VALUES(?, ?, ?, ?, ?, ?, ?)";

	// préparation requete
	$stmt = $bdd->prepare($rqAjout);
	// exécution requete
	$stmt->execute(array($nom, $prenom, $adresse, $cp, $ville, $email, $hash));
	// redirection pour éviter la page blanche
	header('location: index.php');
}
else header('location: inscription.php');



?>