<?php
// connexion BDD
include "includes/connexion.php";

/*echo '<pre>';
var_dump($_POST); //idem print_r() avec les types et la taille
echo '</pre>';*/

// bouton cliqué?
if(isset($_POST['btnSub']))
{
	// Mr Propre
	$idClient = $_POST['idClient'];
	$pass = strip_tags($_POST['pass']);
	$pass2 = strip_tags($_POST['pass2']);

	// pass = pass2?
	if($pass != $pass2) header('location: index.php');
	else{
		// encodage mot de passe
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		// requete de mise à jour
		$rqModifPass = "UPDATE clients 
						SET PassClient = ?, token = '', lost = 0
						WHERE idClient = ?";
		// préparation
		$stmt = $bdd->prepare($rqModifPass);
		// exécution
		$stmt->execute(array($hash, $idClient));
		echo '<script>
				alert("Votre mot de passe a été réinitialisé");
				window.location.replace("login.php");
			  </script>';
	}
}
else header('location: index.php');

?>