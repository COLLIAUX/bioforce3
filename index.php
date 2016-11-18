<?php
//cookie du nombre de visites
if(isset($_COOKIE['mesVisites']))
{
	$nbVisites = $_COOKIE['mesVisites'] + 1;
}
else $nbVisites = 1;
// cookie d'une durée de vie d'un an..
setcookie('mesVisites', $nbVisites, time()+24*3600*365);

$titrePage = "BioForce 3 - Accueil";
// entête et menu
include "includes/entete.php";
?>

<h1>Bienvenue dans notre épicerie Bio</h1>
<?php
//si le cookie n'existe pas = première visite
if(!isset($_COOKIE['mesVisites'])) 
	echo "<h2>C'est la première fois que vous venez, bienvenue chez vous!</h2>";
else echo "<h2>C'est votre ".($_COOKIE['mesVisites']+1).'<sup>e</sup> visite</h2>';
/* PAUSE KAWA */

?>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fermentum sapien vitae metus tempus, eu vehicula arcu aliquet. Etiam et egestas enim. Morbi congue mollis dui, quis bibendum tellus egestas molestie. Duis ac purus quis nibh venenatis sagittis. Phasellus ac neque turpis. Aliquam erat volutpat. Nam viverra, erat eget condimentum lobortis, nunc neque aliquet turpis, ut convallis lectus magna sit amet nibh. Curabitur ac nisi vitae purus mattis luctus ac eget eros. In a varius felis. Aliquam blandit egestas sapien sed placerat. Nullam maximus massa et blandit efficitur. Phasellus sodales, leo vel euismod varius, leo felis efficitur turpis, rhoncus consectetur velit dui sed est. Suspendisse at magna et justo scelerisque ullamcorper. Phasellus eu commodo lorem. Praesent malesuada lorem erat, a aliquet nisl hendrerit in.</p>

<p>Sed consequat auctor iaculis. Aliquam vestibulum quam eros, eget volutpat mi vestibulum eget. Morbi quis arcu hendrerit, efficitur dolor a, venenatis mi. Cras feugiat placerat facilisis. Pellentesque a mauris sagittis, malesuada risus in, venenatis augue. Curabitur molestie, nulla vitae varius blandit, leo arcu semper velit, nec lobortis lorem felis in arcu. Phasellus in porttitor tellus. Proin sed elit accumsan, porttitor odio in, posuere nisi. Donec porta facilisis pellentesque.</p>

<p>Mauris tristique pellentesque justo at bibendum. Praesent vel orci eu justo scelerisque vulputate. Pellentesque efficitur efficitur est, in tristique erat dignissim ut. Curabitur sit amet ornare mi. Praesent mollis ligula vel urna pulvinar, sit amet convallis tortor congue. Praesent lobortis, elit congue viverra auctor, nulla purus suscipit nunc, eu euismod nunc sem non velit. Vivamus mauris lorem, suscipit rutrum bibendum porttitor, rutrum at ex. Duis at ornare velit. Mauris in aliquam turpis. Nam rutrum cursus est non vulputate.</p>

<?php
// pied de page
include "includes/piedPage.php";
?>