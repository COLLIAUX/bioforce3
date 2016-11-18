<?php
$titrePage = "BioForce3 - Nous contacter";
include "includes/entete.php";
?>
<h1>Nous contacter</h1>
<form method="post" action="contact2.php">
  <div class="form-group">
	<label for="email">Votre adresse mail:</label>
	<input type="email" name="expediteur" id="email" class="form-control" required />
  </div>
  <div class="form-group">
    <label for="message">Votre message:</label>
    <textarea name="message" id="message" rows="10" 
    		  class="form-control" required></textarea>
  </div>
  <div class="form-group text-center">
    <input type="submit" name="btnSub" value="Envoyer" class="btn btn-lg btn-success" />
  </div>
</form>
<?php
include "includes/piedPage.php";
?>