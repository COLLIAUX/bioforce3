<?php
session_start();
include "includes/connexion.php";

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

// le produit à modifier vient du formulaire
$idProduit = $_POST['produit'];
$quantite = $_POST['quantite'];
// le client est dans la session
$idClient = $_SESSION['idClient'];

// requete
$rqPanier = "UPDATE panier
			SET qteProduit = ?
			WHERE idProduit = ?
			AND idClient = ?
			AND validePanier = 0";
// preparation
$stmt = $bdd->prepare($rqPanier);
// execution
$stmt->execute(array($quantite, $idProduit, $idClient));
// retour au panier
header('location: panier.php');
?>