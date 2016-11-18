<nav class="navbar navbar-default">
  <div class="container-fluid">
	<div class="navbar-header">
	  <!-- Bouton pour le menu sur téléphone -->
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
	          data-target="#mon-menu" aria-expanded="false">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="admin2.php">
	  	<span class="glyphicon glyphicon-home"></span> Home
	  </a>
	</div>
	<div class="collapse navbar-collapse" id="mon-menu">
	  <ul class="nav navbar-nav">
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
		     role="button" aria-haspopup="true" aria-expanded="false">
		     Catégories <span class="caret"></span>
		  </a>
		  <ul class="dropdown-menu">
		    <?php
		      // ajout des catégories...
		      $stmt = $bdd->query("SELECT idCategorie, libCategorie
		      					   FROM categories");
		      // récupérer tous les enregistrements sous forme de tableau associatif
		      $listeCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		      //boucle de lecture
		      foreach($listeCategories as $categorie)
		      {
		      	echo '<li><a href="produit.php?cat='.$categorie['idCategorie'].'">
		      	     '.$categorie['libCategorie'].'</a></li>';
		      }
		    ?>
		  </ul>
		</li>
	  </ul>
	  
	  <!-- menu de droite -->
	  <ul class="nav navbar-nav navbar-right">
	    <li><a href="deconnexion.php">
	     	<span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
	  </ul>
	</div>
  </div>		
</nav>