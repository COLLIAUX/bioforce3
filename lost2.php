<?php
// connexion BDD !!!
include "includes/connexion.php";
/*
echo '<pre>';
print_r($_POST); // (réflexe)
echo '</pre>';*/

// bouton cliqué?
if(isset($_POST['btnSub']))
{
	//nettoyage
	$email = strip_tags($_POST['email']);

	// vérifier que l'adresse existe
	$rqVerif = "SELECT idClient
				FROM clients 
				WHERE emailClient = ?";
	$stmt = $bdd->prepare($rqVerif); // préparation
	$stmt->execute(array($email)); //exécution
	$numClient = $stmt->fetchColumn(); //récupération
	//echo '#'.$numClient.'#';
	if($numClient != '')
	{
		// générer un token
		$token = md5($email.date('dmY'));
		$link = "http://".$_SERVER['SERVER_NAME'].
				"/bioforce3/lost3.php?token=".$token;
		echo $link;
		//envoyer un mail
		require "includes/phpmailer/PHPMailerAutoload.php";
		$mail = new PHPMailer; // nouvel objet de type mail
		$mail->isSMTP(); // on va se connecter directement au serveur SMTP
		$mail->isHTML(true); // on va utiliser le format HTML pour le message
		$mail->Host = "smtp.gmail.com"; // le serveur SMTP utilisé
		$mail->Port = 465; //le port utilisé pour le SMTP
		$mail->SMTPAuth = true; // on va donner des infos au serveur (login/mdp)
		$mail->SMTPSecure = 'ssl'; //certificat SSL
		$mail->Username = "bioforce3@gmail.com"; // utilisateur pour le SMTP
		$mail->Password= "Azerty1234"; // mot de passe pour le SMTP
		$mail->setFrom('bioforce3@gmail.com', 'BioForce 3'); // l'expediteur
		$mail->addAddress($email); // le destinataire depuis le formulaire
		$mail->Subject = utf8_decode('BioForce3 - Récupération de votre mot de passe'); // le sujet du mail
		$mail->Body = '<html>
					<head>
					<meta charset="utf-8" />
					<style>
					h1{color: green;}
					</style>
					</head>
					<body>
					<h1>Mot de passe perdu</h1>
					<p>Vous avez signalé votre mot de passe comme oublié. Veuillez cliquer sur le lien suivant pour le réinitialiser.</p>
					<a href="'.$link.'">Réinitialiser mon mot de passe</a>
					</body>
					</html>'; // le contenu du mail en HTML
		if(!$mail->send()) // si l'envoi délire...
		{
			echo 'Erreur envoi: '.$mail->ErrorInfo;
		}
		else
		{
			echo 'envoyé';
			//mettre à jour la BDD
			$majToken = "UPDATE clients
						 SET token = ?, lost = 1
						 WHERE idClient = ?";
			$stmtToken = $bdd->prepare($majToken);
			$stmtToken->execute(array($token, $numClient));
			// appel dynamique d'unfichier JS
			echo '<script src="js/lost2.js"></script>';
	
		}
		
	}

}
//sinon retour accueil
else header('location: index.php');

?>