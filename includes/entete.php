<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titrePage; ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css" /> 
	<link rel="stylesheet" href="css/font-awesome.min.css" /> 
	<link rel="stylesheet" href="css/style.css" />
	<script src="js/jquery-2.2.4.min.js"></script> 
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
   <header class="header">
	<div class="row">
	  <div class="col-md-3">
	  	<img src="images/logo.jpg" class="img-responsive img-rounded" alt="logo" />
	  </div>
	  <div class="col-md-9">
		<hgroup>
		  <h1>BioForce 3</h1>
	  	  <h2>Epicerie Bio du Perray</h2>
		</hgroup>
	  </div>
	</div>
   </header>
   <?php
    // récupération d'une connexion à la BDD
    include "connexion.php";
    //ajout du menu
	include "menu.php"; 
   ?>