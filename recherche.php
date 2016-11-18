<?php
$titrePage = "BioForce3 - Recherche";
include "includes/entete.php";

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

// Mr Propre
$produit = htmlentities(strip_tags($_POST['produit']));
// requete
$rqRecherche = "SELECT idProduit, idCategorie, libProduit, descProduit, 
					   photoProduit, prixProduit
				FROM produits
				WHERE libProduit LIKE ?";
// préparation
$stmt = $bdd->prepare($rqRecherche);
// exécution
$stmt->execute(array('%'.$produit.'%'));
//récupération résultat
$listeProduits = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*echo '<pre>';
print_r($listeProduits);
echo '</pre>';*/
echo '<div class="row">';
foreach($listeProduits as $prod)
{
	echo '<div class="panel panel-default col-md-4 col-xs-12">
			<div class="panel-body text-center">';
	echo '<h3>'.$prod['libProduit'].'</h3>';
	echo '<img src="images/'.$prod['photoProduit'].'" 
			   class="img-responsive img-circle" />';
	echo '<p>'.$prod['descProduit'].'</p>';
	echo '<p><strong>'.$prod['prixProduit'].'</strong></p>';
	//si l'utilisateur est loggué
	if(isset($_SESSION['auth']))
	{
		echo '<form method="post" action="ajoutPanier.php">';
		echo '<input type="hidden" name="cat" value="'.$prod['idCategorie'].'" />';
		// pour le produit 1 name="quantite[1]"
		echo '<input type="number" name="quantite['.$prod['idProduit'].']"
				     placeholder="Quantité" min="1" class="form-control" /><br/>';
		echo '<input type="submit" name="btn['.$prod['idProduit'].']" 
					 class="btn btn-lg btn-success" value="Commander" />';
		echo '</form>';
	}
	else //sinon
	{
		echo '<p><em>Vous devez vous authentifier pour commander</em></p>';
	}

	echo '  </div>
		  </div>'; //fermeture panel
}
echo '</div>'; //fermeture div class="row"



include "includes/piedPage.php"
?>