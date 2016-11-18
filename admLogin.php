<?php
session_start();

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/
if(isset($_POST['btnSub']))
{
  //Mr Propre
  $login = htmlentities(strip_tags($_POST['login']));
  $pass = htmlentities(strip_tags($_POST['pass']));
  // controle utilisateur
  if($login == 'admin' AND $pass == 'Azerty1234')
  {
  	//enregistrement dans la session
  	$_SESSION['admin'] = 'ok';
  	header('location: admin2.php');
  }
  else header('location: admin.php');
}
else header('location: admin.php');
?>