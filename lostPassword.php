<?php
$titrePage = "BioForce 3 - Mot de passe oublié";
// entête et menu
include "includes/entete.php";
?>
<form method="post" action="lost2.php">  
  <div class="row">
    <div class="col-md-offset-4 col-md-4">
	  <div class="form-group">
		<label for="mail">Adresse mail</label>
		<input type="email" name="email" id="mail" class="form-control" required />
  	  </div>
  	  <div class="form-group text-center">
    	<input type="submit" name="btnSub" value="Envoyer" 
    	 	   class="btn btn-lg btn-success" />
  	  </div>
  	</div>
  </div>
</form>
<?php
include "includes/piedPage.php";
?>