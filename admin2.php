<?php
$titrePage = "Administration";
include "includes/enteteAdmin.php";

//Afficher la liste des catégories
$rqCategories = "SELECT idCategorie, libCategorie
				 FROM Categories";
$stmt = $bdd->query($rqCategories);
$listeCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<div class="row">
	   <div class="panel panel-default col-md-4">
		<div class="panel-body">';

echo '<table class="table table-bordered table-striped">
	   <thead>	
		<tr>
		  <th>Libellé</th>
		  <th>Suppression</th>
		</tr>
	   </thead>
	   <tbody>';
foreach($listeCategories as $categorie)
{
	echo '<tr>
		   <td>'.$categorie['libCategorie'].'</td>
		   <td><form method="post" action="suppCategorie.php">
		   		<input type="hidden" name="categorie"
		   		       value="'.$categorie['idCategorie'].'" />
		   		<input type="submit" name="btnSupp"   
		   			   value="Supprimer" 
		   			   class="btn btn-xs btn-danger" />
		   		</form>
		   	</td>
		   </tr>';
}
echo ' </tbody>
	 </table>
	 </div>
	 </div>';

//formulaire ajout catégorie
// (libCategorie)
?>
<div class="panel panel-default col-md-4">
	<div class="panel-body">
		<form method="post" action="ajoutCategorie.php">
		  <div class="form-group">
		    <label for="cat">Catégorie</label>
			<input type="text" name="categorie" id="cat"
				   class="form-control" />
		  </div>
		  <div class="form-group text-center">
		    <input type="submit" name="btnSub" value="Ajouter"
		           class="btn btn-success" />
		  </div>
		  </form>
	</div>
</div>

<div class="panel panel-default col-md-4">
	<div class="panel-body">
		<form method="post" action="ajoutProduit.php"
			  enctype="multipart/form-data" >
		<!-- enctype pour envoyer des fichiers -->
		<div class="form-group">
		  <label for="lib">Libellé Produit:</label>
		  <input type="text" name="libProduit" id="lib"
		  		 class="form-control" required />
		</div>
		<div class="form-group">
		  <label for="categorie">Catégorie:</label>
		  <select name="idCategorie" id="categorie" 
		  		  class="form-control">
		  	<option value='' disabled selected>
		  		Choisissez une catégorie</option>
		<?php
		//parcours des catégories
		foreach($listeCategories as $cat)
		{
			echo '<option value="'.$cat['idCategorie'].'">
				 '.$cat['libCategorie'].'</option>';
		}
		?>
		  </select>
		</div>
		<div class="form-group">
		  <label for="desc">Description</label>
		  <textarea name="descProduit" id="desc"
		            class="form-control" required></textarea>
		</div>
		<div class="form-group">
		  <label for="photo">Photo du produit:</label>
		  <input type="file" name="photoProduit" id="photo"
		  	     class="form-control" accept="image/*" required />
		<!-- l'attribut accept permet de forcer les types de fichiers autorisés -->
		</div>
		<div class="form-group">
		  <label for="prix">Prix:</label>
		  <input type="text" name="prixProduit" id="prix"
		  		 class="form-control" required />
		</div>
		<div class="form-group text-center">
		    <input type="submit" name="btnSub" value="Ajouter"
		           class="btn btn-success" />
		  </div>
		</form>
	</div>
</div>
<?php
include "includes/piedPage.php";
?>