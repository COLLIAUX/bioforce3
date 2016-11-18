<?php
session_start();

echo '<pre>';
print_r($_POST);
// le fichier envoyé
print_r($_FILES);
echo '</pre>';
// récupérer l'image
if(isset($_FILES['photoProduit']))
{
	$repertoire = 'images/'; // le répertoire ou copier l'image
	$fichier = $_FILES['photoProduit']['name']; //le nom de l'image
	$tmpName = $_FILES['photoProduit']['tmp_name']; //le fichier temporaire
	if(move_uploaded_file($tmpName, $repertoire.$fichier))
	{
		//Mr Propre
		$libProduit = htmlentities(strip_tags($_POST['libProduit']));
		$descProduit = htmlentities(strip_tags($_POST['descProduit']));
		$idCategorie = $_POST['idCategorie'];
		$prixProduit = $_POST['prixProduit'];

		//connexion
		include 'includes/connexion.php';
		$rq = "INSERT INTO produits(libProduit, idCategorie, descProduit, photoProduit, 
									prixProduit)
			   VALUES(?, ?, ?, ?, ?)";
		$stmt = $bdd->prepare($rq);
		$stmt->execute(array($libProduit, $idCategorie, $descProduit, 
							 $fichier, $prixProduit));
		print_r($bdd->errorInfo());
		//retour à l'admin2
		echo '<script>
				alert("produit ajouté");
				window.location.replace("admin2.php");
			  </script>';
	}
	else echo 'Erreur lors du chargement de l\'image';

}

?>