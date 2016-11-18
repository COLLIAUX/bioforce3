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
	  <a class="navbar-brand" href="index.php">
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
		<?php
			/* si on est connecté on affiche le panier */
		  	if(isset($_SESSION['auth']))
		  	{
				echo '<li><a href="panier.php">
		  			<span class="glyphicon glyphicon-shopping-cart"></span> Panier';
		  
		  		// compter le nombre d'articles non validés dans le panier 
		  		$rqPanier = "SELECT COUNT(idProduit) 
		  					 FROM panier
		  					 WHERE idClient = ".$_SESSION['idClient']."
		  					 AND validePanier = 0";
		  		//exécution
		  		$stmtPanier = $bdd->query($rqPanier);
		  		$nbArticles = $stmtPanier->fetchColumn(0);
		  		//affichage
		  		echo '<span class="badge">'.$nbArticles.'</span>';
		  	}
		  ?>
		  </a>
		</li>
	  </ul>
	  
	  <!-- formulaire de recherche -->
	  <form class="navbar-form navbar-right" method="post" action="recherche.php" >
	    <div class="form-group">
	      <input type="text" class="form-control" placeholder="Produit" 
	      		 name="produit" id="rechercheProduit" />
	    </div>
	    <button type="submit" class="btn btn-default" id="btnSearch">Rechercher</button>
	  </form>

	  <!-- menu de droite -->
	  <ul class="nav navbar-nav navbar-right">
		<?php
		if(!isset($_SESSION['auth']))
		{
			echo '<li><a href="inscription.php">
		       		<span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				  <li><a href="login.php">
			   		<span class="fa fa-plug"></span> Connexion</a></li>';
		}
		else echo '<p class="navbar-text">'.$_SESSION['prenom']
										   .' '.$_SESSION['nom'].'</p>
				  <li><a href="deconnexion.php">
			     	<span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>';
		?>
		<li><a href="contact.php">
		       <span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
	  </ul>
	</div>
  </div>		
</nav>