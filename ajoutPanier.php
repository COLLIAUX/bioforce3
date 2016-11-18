<?php
session_start();
// connexion BDD
include "includes/connexion.php";

/*echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

/*
$tableau = array(0 => 'toto', 'truc'=>'muche');
array_keys renvoie array(0, 'truc');
array_values renvoie array('toto', 'muche');
*/
// bouton cliqué
$idBtn = array_keys($_POST['btn']);
$idProduit = $idBtn[0];
//echo $idProduit;
$quantite = $_POST['quantite'][$idProduit];
// l'identifiant du client est dans la session...
$idClient = $_SESSION['idClient'];

// si quantité vide on renvoie à la page produit
if($quantite == '') header('location: produit.php?cat='.$_POST['cat']);
else{

	// le produit est déjà dans le panier?
	$verifProduit = "SELECT count(*) 
					 FROM panier
					 WHERE idClient = :idClient
					 AND idProduit = :idProduit
					 AND validePanier = 0";
	$stmt2 = $bdd->prepare($verifProduit);
	$stmt2->execute(array(':idProduit' => $idProduit, ':idClient' => $idClient));
	$existProduit = $stmt2->fetchColumn();
	// si 0 on ajoute le produit (INSERT)
	if($existProduit == 0)
	{
		$rqAjout = "INSERT INTO panier(idClient, idProduit, qteProduit)
					VALUES(:idClient, :idProduit, :qteProduit)";
	}
	// sinon on met à jour (UPDATE)
	else
	{
		$rqAjout = "UPDATE panier
					SET qteProduit = :qteProduit
					WHERE idClient = :idClient
					AND idProduit = :idProduit
					AND validePanier = 0";
		// PAUSE 
	}
	// preparation
	$stmt = $bdd->prepare($rqAjout);
	// exécution
	$stmt->execute(array(':idClient' => $idClient, ':idProduit' => $idProduit,
						 ':qteProduit' => $quantite));

	header('location: produit.php?cat='.$_POST['cat']);
}
/* pour le panier il faut:
- idClient
- idProduit
- quantité */

?>