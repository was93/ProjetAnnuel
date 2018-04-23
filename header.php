<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Le Festival Restaurant</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- SEO --> 
	<meta name="keywords" content="Restaurant LE FESTIVAL, Cuisine Provençale, Créative,LE FESTIVAL,restaurant,Tourcoing, Lille, Plaine Images">
	<meta name="description" content="Restaurant LE FESTIVAL - Tourcoing. Cuisine: Provençale, Créative. Perché sur les hauteurs du Studio national des arts contemporains du Fresnoy à Tourcoing, Le Festival c'est l'histoire d'un restaurant décalé où l'on vient autant pour le contenu que pour le contenant. Franck Lapouge, féru de cuisine méditerranéenne vous régale d'un foie gras poêlé aux figues fraiches, de son beignet de courgettes salsa verde (mayonnaise mentholée), de sa symphonie de poissons grillés et de ses grands raviolis à la poivrade d'artichaut et à la truffe blanche de mascarpone. Et puis, il y a les classiques tels que le face-à-face : un saumon snacké avec son pavé de boeuf grillé déglacé, pour ne plus hésiter entre viande et poisson...Le Festival, c'est aussi un décor : une terrasse vertigineuse idéale pour prendre l'apéro en contemplant ce superbe héritage de l'ère industrielle... à l'intérieur, c'est toute une ambiance qui est revisitée. Au centre de la salle, un trône, celui de Richard III, en provenance directe du théâtre Marigny, à Paris ; plus loin ce sont des tableaux penchés qui interrogent...Le Festival, c'est le lieu où vous n'avez pas à choisir entre l'atmosphère et le goût : tout y est !">

</head>
<header>

	<!-- MENU NAVBAR -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
		<a class="navbar-brand" href="#"><img class="palme" src="img/palme.png"><img class="title" src="img/title.png"></a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

					<li class="nav-item active">
						<a class="nav-link active" href="index.php">Accueil</a>
					</li>
				

			<?php

		      	if( admin()  ){
		      ?>

			      	<li class="nav-item active">
				        <a class="nav-link" href="listOfUsers.php">utilisateurs</a>
				    </li>

				    <li class="nav-item active">
				        <a class="nav-link" href="listOfCards.php">Cartes</a>
				    </li>

				    <li class="nav-item active">
					<a class="nav-link active" href="resa.php">Réservation</a>
					</li>

			      	<li class="nav-item active">
				    	<a class="nav-link" href="deconnexion.php">Déconnexion</a>
				    </li>
		      <?php
		      	}else{
		      		if( isConnected()  ){
			      ?>

				    <li class="nav-item active">
				        <a class="nav-link" href="plats.php">Cartes</a>
				    </li>

				    <li class="nav-item active">
					<a class="nav-link active" href="resa.php">Réservation</a>
					</li>

			      	<li class="nav-item active">
				    	<a class="nav-link" href="deconnexion.php">Déconnexion</a>
				    </li>
		      <?php
		      	}else{
			      ?>

			      	<li class="nav-item active">
				        <a class="nav-link active" href="signup.php">S'inscrire/Se connecter</a>
				    </li>

			      <?php
		      		}
		      	}

		      ?>



		    	<li class="nav-item active">
					<a class="nav-link active" href="team.php">Facebook</a>
				</li>


			</ul>
		</div>
	</nav>


	<div class="container-fluid">