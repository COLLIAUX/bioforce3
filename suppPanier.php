<?php
session_start();
include "includes/connexion.php";

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/
if(isset($_POST['btnSub']))
{
	// le produit à supprimer vient du formulaire
	$idProduit = $_POST['produit'];
	// le client est dans la session
	$idClient = $_SESSION['idClient'];
	$rqSupp = "DELETE FROM panier 
			   WHERE idProduit = ?
			   AND idClient = ?
			   AND validePanier = 0";
	//préparation
	$stmt = $bdd->prepare($rqSupp);
	//exécution
	$stmt->execute(array($idProduit, $idClient));
}
// retour à l'affichage du panier
header('location: panier.php');
?>