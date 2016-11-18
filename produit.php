<?php
$titrePage = "BioForce 3 - Nos produits";
// entête et menu
include "includes/entete.php";

// récupération de la catégorie dans l'url
$idCategorie = htmlentities(strip_tags($_GET['cat']));

// récupération de la catégorie dans la BDD
$rqCat = "SELECT libCategorie
		  FROM categories
		  WHERE idCategorie = :idCategorie";
$stmt2 = $bdd->prepare($rqCat);
// exécution de la requete préparée et assignation des paramètres
$stmt2->execute(array(':idCategorie' => $idCategorie));
// récup du libellé
$libCategorie = $stmt2->fetchColumn(0);
//affichage
echo '<h1>'.$libCategorie.'</h1>';

// récupération de la liste des produits pour cette catégorie
$rqProduits = "SELECT idProduit, libProduit, descProduit, photoProduit, prixProduit
			   FROM produits
			   WHERE idCategorie = ?";
$stmt3 = $bdd->prepare($rqProduits);
$stmt3->execute(array($idCategorie));
$listeProduits = $stmt3->fetchAll(PDO::FETCH_ASSOC);
// affichage de controle
/*echo '<pre>';
print_r($listeProduits);
echo '</pre>';*/


echo '<form method="post" action="ajoutPanier.php">
	  <input type="hidden" name="cat" value = "'.$idCategorie.'" />
<div class="row">';
foreach($listeProduits as $index=>$produit)
{
	
	echo '<div class="panel panel-default col-md-4 col-xs-12">
			<div class="panel-body text-center">';
	echo '<h3>'.$produit['libProduit'].'</h3>';
	echo '<img src="images/'.$produit['photoProduit'].'" class="img-responsive img-circle" />';
	echo '<p>'.$produit['descProduit'].'</p>';
	echo '<p><strong>'.$produit['prixProduit'].'</strong></p>';
	//si l'utilisateur est loggué on affiche le formulaire
	if(isset($_SESSION['auth']))
	{
		echo '<input type="number" name="quantite['.$produit['idProduit'].']" 
					 placeholder="Quantité" min="1"
					 class="form-control" /><br/>
			  <input type="submit" name="btn['.$produit['idProduit'].']" 
			         class="btn btn-success btn-lg" value="Commander" />';
	}
	// sinon on affiche un message demandant de se connecter
	else echo '<p class="text-center">
				 <em>Vous devez vous authentifier pour commander</em>
			   </p>';

	echo '  </div>
		  </div>';
	if(($index + 1) % 3 == 0 AND $index != 0) echo '</div><div class="row">';
}
echo '</div>
</form>';
?>


<?php
// pied de page
include "includes/piedPage.php";
?>