<?php
$titrePage = "BioForce 3 - Inscription";
// entête et menu
include "includes/entete.php";
?>
<form method="post" action="ajoutClient.php">
<!-- nom, prenom, adresse, cp, ville, email, mdp -->
<div class="form-group">
	<label for="nom">Nom:</label>
	<input type="text" name="nom" id="nom" class="form-control" required />
</div>
<div class="form-group">
	<label for="prenom">Prénom:</label>
	<input type="text" name="prenom" id="prenom" class="form-control" required />
</div>
<div class="form-group">
	<label for="addr">Adresse:</label>
	<input type="text" name="adresse" id="addr" class="form-control" required />
</div>
<div class="form-group">
	<label for="cp">Code Postal:</label>
	<input type="text" name="cp" id="cp" class="form-control" required />
</div>
<div class="form-group">
	<label for="ville">Ville:</label>
	<input type="text" name="ville" id="ville" class="form-control" required />
</div>
<div class="form-group">
	<label for="email">Email:</label>
	<input type="email" name="email" id="email" class="form-control" required />
</div>
<div class="form-group">
	<label for="mdp">Mot de passe:</label>
	<input type="password" name="mdp" id="mdp" class="form-control" required />
</div>
<div class="form-group text-center">
	<input type="submit" name="btnSub" value="S'inscrire" class="btn btn-lg btn-success" />
</div>
</form>
<?php
include "includes/piedPage.php";
?>
