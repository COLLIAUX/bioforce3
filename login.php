<?php
$titrePage = "BioForce 4 - Authentification";
// entête et menu
include "includes/entete.php";
?>
<form method="post" action="login2.php">
<div class="form-group">
	<label for="mail">Email:</label>
	<input type="email" id="mail" name="email" class="form-control" required />
</div>
<div class="form-group">
	<label for='pass'>Mot de Passe:</label>
	<input type="password" id="pass" name="pwd" class="form-control" required />
</div>
<div class="form-group text-center">
	<input type="submit" name="btnSub" value="Entrer" class="btn btn-lg btn-success" />
	<p><a href="lostPassword.php">Mot de passe perdu</a></p>
</div> 
</form>
<?php
include "includes/piedPage.php";
?>