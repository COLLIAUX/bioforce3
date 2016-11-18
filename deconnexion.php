<?php
session_start();
//suppression des variables de session
session_unset(); // ou $_SESSION = array();
//destruction de la session
session_destroy();
//retour à l'index
header('location: index.php');
?>