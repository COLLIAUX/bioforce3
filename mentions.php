<?php
$titrePage = "BioForce3 - Mentions Légales";
include "includes/entete.php";
// méthode facile...
echo '<pre>';
echo file_get_contents('docs/mentions.txt'); //lecture d'un fichier txt
echo '</pre>';

include "includes/piedPage.php";
?>