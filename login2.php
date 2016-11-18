<?php
//connexion
session_start();
include "includes/connexion.php";

if(isset($_POST['btnSub']))
{
	//Mr Propre
	$email = htmlentities(strip_tags($_POST['email']));
	$pass  = htmlentities(strip_tags($_POST['pwd']));

	$rqLogin = "SELECT idClient, nomClient, prenomClient, PassClient
				FROM clients 
				WHERE emailClient = :email";
	//preparation
	$stmt = $bdd->prepare($rqLogin);
	//exécution
	$stmt->execute(array(':email' => $email));
	//récupération résultat
	$infosClient = $stmt->fetch(PDO::FETCH_ASSOC);

	/* pour verif et debug 
	echo '<pre>';
	print_r($infosClient);
	echo '</pre>';*/
	// le mot de passe est-il bon?
	if(password_verify($pass, $infosClient['PassClient']))
	{
		// enregistrement des valeurs de session
		$_SESSION['auth'] = 'ok';
		$_SESSION['nom'] = $infosClient['nomClient'];
		$_SESSION['prenom'] = $infosClient['prenomClient'];
		$_SESSION['idClient'] = $infosClient['idClient'];

		// en JS: window.location.assign(url) fait une redirection
		// et place la page actuelle dans l'historique.
		// window.location.replace(url) fait une redirection sans
		// mettre la page actuelle dans l'historique
		echo '<script type="text/javascript">
			    alert("Bienvenue '.$infosClient['prenomClient'].' '
			                      .$infosClient['nomClient'].'");
			    window.location.replace("index.php");
			  </script>';
	}
	else header('location: login.php');

}
else header('location:login.php');




?>