<?php
$titrePage = "Admin";
include "includes/enteteAdmin.php";
?>
<form method="post" action="admLogin.php">
  <div class="form-group">
	<label for="login">Login:</label>
	<input type="text" name="login" id="login" class="form-control" required />
  </div>
  <div class="form-group">
    <label for="mdp">Mot de Passe:</label>
    <input type="password" name="pass" id="pwd" class="form-control" required /> 
  </div>
  <div class="form-group text-center">
	<input type="submit" name="btnSub" value="Entrer" class="btn btn-lg btn-success" />
  </div>
</form>
<?php
include 'includes/piedPage.php';
?>