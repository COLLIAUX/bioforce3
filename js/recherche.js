$(document).ready(function(){
	// vérifier qu'il est bien chargé
	//alert('Yo');

	// le bouton d'id "btnSearch" 
	$("#btnSearch").on('click', function(){
		//recherche vide
		if($("#rechercheProduit").val() == '')
		{
			alert("La recherche ne peut être vide");
			return false;
		}
	});

});