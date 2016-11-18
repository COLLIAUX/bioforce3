<?php
$titrePage = "BioForce3 - fichiers et répertoires";
include "includes/entete.php";

/*
// log des accès aux mentions légales
$dte = date('d/m/Y H:i:s'); //date jour/mois/année heure:minute:secondes
$ip = $_SERVER['REMOTE_ADDR']; // adresse IP du client
file_put_contents('docs/logs.txt', $dte.' '.$ip.PHP_EOL, FILE_APPEND);
// logs.txt nom du fichier
// PHP_EOL saut de ligne
// FILE_APPEND écrire à la suite du fichier

/* copier un fichier */
/*copy('docs/logs.txt', 'docs/log2.txt');
/* renommer un fichier */
/*rename('docs/log2.txt', 'docs/log3.txt');
/* suppression */
/*unlink('docs/log3.txt');
//existence
if(file_exists('docs/logs.txt')) echo 'il est là...';
// taille
echo filesize('docs/logs.txt');*/

// ouverture du fichier en lecture seule
$fd = fopen('docs/mentions.txt', 'r');
//lecture du contenu (les 50 premiers caractères)
//$contenu = fread($fd, 67);
$cpt = 1;
while(!feof($fd)) // tant que l'on n'a pas atteint la fin du fichier
{
	$ligne = fgets($fd, 4096); // récupération du contenu d'une ligne
	if($cpt % 2 == 0) $cls = 'pair'; //si ligne paire, classe CSS pair
	else $cls = 'impair'; //si ligne impaire, classe CSS impair
	$contenu = '<p class="'.$cls.'">'.$cpt++.': '.$ligne.'</p>';
	echo $contenu; //affichage
}

//fermeture
fclose($fd);

// lecture en tableau
$aLogs = file('docs/logs.txt');
echo '<pre>';
print_r($aLogs);
echo '</pre>';

/* EXPORT DES CLIENTS DANS UN FICHIER CSV */
$rq = "SELECT * FROM clients"; //requete
$stmt = $bdd->query($rq); //exécution
$listeClients = $stmt->fetchALL(PDO::FETCH_NUM); //récupération du résultat

// ouverture fichier
$fd = fopen('docs/clients.csv', 'w');

//boucle sur la liste des clients
foreach($listeClients as $client)
{
	fputcsv($fd, $client, ';'); //écriture ligne CSV, séparateur ;
}
//fermeture fichier !!!!!
fclose($fd);


/* lecture répertoire */
$repertoire = 'images';
// est-ce bien un répertoire?
if(is_dir($repertoire))
{
	//est-ce que j'arrive à l'ouvrir?
	if($dh = opendir($repertoire))
	{
		echo '<div class="row">';
		//boucle sur la lecture
		while(($fichier = readdir($dh)) !== false)
		{
			// virer . et ..
			if($fichier == '.' OR $fichier == '..') continue;
			$legende = substr($fichier,0,-4);
			echo '<figure class="col-md-3">
					<img src="images/'.$fichier.'" class="magic" 
					     alt="'.$legende.'" title="'.$legende.'" />
					<figcaption>'.$legende.'</figcaption>
				  </figure>';
		}
		echo '</div>';
		// fermeture!!!
		closedir($dh);
	}
}

include "includes/piedPage.php";
?>
