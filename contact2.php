<?php
session_start();

// vérification du formulaire...
/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

/* le bouton a été cliqué? */
if(isset($_POST['btnSub']))
{
	// Mr Propre
	$expediteur = htmlentities(strip_tags($_POST['expediteur']));
	$message = strip_tags($_POST['message']);

	/* envoi du mail */
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
	$mail->addAddress('ophois34@gmail.com'); // le destinataire
	$mail->Subject = 'message de '.$expediteur; // le sujet du mail
	$mail->Body = "<html>
					<head>
					<style>
					h1{color: blue;}
					</style>
					</head>
					<body>
					<h1>Message de ".$expediteur."</h1>
					".$message."
					</body>
					</html>"; // le contenu du mail en HTML
	if(!$mail->send()) // si l'envoi délire...
	{
		echo 'Erreur envoi: '.$mail->ErrorInfo;
	}
	// si mail envoyé, remerciement et retour page d'accueil
	else echo '<script>
			   alert("Merci! Votre message a bien été envoyé.");
			   window.location.replace("index.php");
			   </script>';

}
else header('index.php');


?>