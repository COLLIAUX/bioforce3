<?php
$titrePage = "BioForce 3 - Visualiser le panier";
// entête et menu
include "includes/entete.php";

//recherche dans le panier et jointure avec les produits
$rqPanier = "SELECT p.idProduit, p.qteProduit, a.libProduit, a.prixProduit
			 FROM panier p
			 JOIN produits a
			 ON a.idProduit = p.idProduit
			 WHERE p.idClient = :idClient
			 AND p.validePanier = 0
			 ORDER BY a.idCategorie, p.idProduit";
//preparation
$stmt = $bdd->prepare($rqPanier);
//exécution
$stmt->execute(array(':idClient' => $_SESSION['idClient']));
// afficher le resultat
$panierClient = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*
echo '<pre>';
print_r($panierClient);
echo '</pre>';*/

/* stockage du panier dans un fichier texte */
$fichier = 'docs/panier_'.$_SESSION['idClient'].'.txt';
file_put_contents($fichier, serialize($panierClient));

echo '<table class="table table-striped">
		<thead>
		<tr>
		  <th>Designation</th>
		  <th>quantite</th>
		  <th>Prix Unitaire</th>
		  <th>prix à payer</th>
		  <th>Actions</th>
		</tr>
		</thead>
		<tbody>';

$total = 0; // montant total
foreach($panierClient as $produit)
{
	$designation = $produit['libProduit'];
	$idProduit = $produit['idProduit'];
	$quantite = $produit['qteProduit'];
	$prix = $produit['prixProduit'];
	$montantLigne = $prix * $quantite;
	$total += $montantLigne; // $total = $total + $montantLigne;
	echo '<tr>
			<td>'.$designation.'</td>
			<td>
			  <form method="post" action="modifPanier.php">
				<input type="hidden" name="produit" value="'.$idProduit.'" />
				<input type="number" min="1" name="quantite" value="'.$quantite.'" />
				<input type="submit" name="btnSub" 
			           value="Modifier" class="btn btn-xs btn-success" />
			  </form>
			</td>
			<td class="text-right">'.number_format($prix, 2, ',', ' ').' €</td>
			<td class="text-right">'.number_format($montantLigne,2, ',', ' ').' €</td>
			<td>
			  <form method="post" action="suppPanier.php">
			    <input type="hidden" name="produit" value="'.$idProduit.'" />
			    <input type="submit" name="btnSub" 
			           value="Supprimer" class="btn btn-xs btn-warning" />
			  </form>
			</td>
		  </tr>';
		  // number_format(nombre, nb decimales, separateur décimal, separateur milliers)
}
echo '</tbody>
	  <tfoot>
	  <tr>
	    <td colspan = "3">total</td>
	    <td class="text-right">'.number_format($total,2, ',', ' ').' €</td>
	    <td></td>
	  </tr>
	  </tfoot>
	  </table>';

// formulaire validation panier
echo '<form method="post" action="validePanier.php">
		<div class="form-group text-center">
		  <input type="submit" name="btnSub" value="Valider" 
		  		 class="btn btn-lg btn-success" />
		</div>
	  </form>';


include "includes/piedPage.php";
?>