<?php
session_start();
//connexion BDD
include 'includes/connexion.php';

// déplacement du fichier txt contenant le panier
$fichier = 'docs/panier_'.$_SESSION['idClient'].'.txt';
$commande = 'commandes/commande_'.$_SESSION['nom'].'_'.date('YmdHis').'.txt';
rename($fichier, $commande);
/* BON APPETIT */
// requete
$rq = "UPDATE panier
	   SET validePanier = 1
	   WHERE idClient = ?
	   AND validePanier = 0";
// préparation
$stmt = $bdd->prepare($rq);
// execution (le client est dans la session)
$stmt->execute(array($_SESSION['idClient']));
//remerciements
echo '<script>
	 	alert("Merci pour votre commande.");
	 	window.location.replace("index.php");
	  </script>';
?>