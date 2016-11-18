<?php
session_start();
include "includes/connexion.php";

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

//requete
$rq = "INSERT INTO categories(libCategorie)
		VALUES(?)";
//prepare
$stmt = $bdd->prepare($rq);
//execute
$stmt->execute(array($_POST['categorie']));

//retour à l'admin2
echo '<script>
		alert("catégorie ajoutée");
		window.location.replace("admin2.php");
	  </script>';


?>