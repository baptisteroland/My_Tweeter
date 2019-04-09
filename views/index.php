<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion/incription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">

	<?php include('../controller/bdd.php');//include('navbar.php');?>

			<link rel="stylesheet" type="text/css" href="css/theme_default/style.css">
			<link rel="stylesheet" type="text/css" href="css/theme_default/navbar.css">
			<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
			<link rel="stylesheet" type="text/css" href="css/theme_default/messagerie.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
	</head>
	<body>
		<div class="contain--pict--left d-lg-block d-md-none d-none float-left">
			<div class="container col-lg-6 contain--test">
				<div class="container">
					<img src="img/icon_search.png" alt="loop sur le texte"><span class="ml-3 font-weight-bold text-light h5">Suivez vos passions.</span>
				</div>
				<div class="mt-5 container">
					<img src="img/icon_users.png" alt="user icon sur texte"><span class="ml-3 font-weight-bold text-light h5">Découvrez ce dont les gens parlent.</span>
				</div>
				<div class="mt-5 container">
					<img src="img/icon_comment.png" alt="icone comment"><span class="ml-3 font-weight-bold text-light h5">Rejoignez la conversation.</span>
				</div>
			</div>
		</div>
		<div class="d-lg-none d-md-none d-block text-center mt-5">
			<p class="font-weight-bold h1">Tweet<i class="fas fa-at icon--wac  mt-1 ml-2 mb-2"></i><span class="color--blue">cademie</span></p>
		</div>
		<div class="containe--form--all col-lg-6">
			<div class="contain--connect col-md-12 col-sm-12 text-md-center text-lg-right mr-5 mt-lg-2 mt-md-2 mt-2">
							<form method="post" action="../modele/login.php">
					<input type="text" name="email" placeholder="Téléphone, email ou nom d'utilisateur" class="p-2 mt-4 col-lg-4 col-md-4 col-sm-12 ">
					<input type="password" name="password" placeholder="Mot de passe" class="p-2 ml-lg-2 ml-md-2 ml-sm-0 mt-4 col-lg-4 col-md-4 col-sm-12 mb-sm-2">
					<input type="submit" name="connect" value="Se connecter" class="btn button--connect font-weight-bold ml-2 p-2 d-lg-inline d-md-inline-block d-block">
				</form>
			</div>

			<div class="contain--carre--log col-lg-5 col-md-5 d-lg-block d-md-block d-none container">
				<div class="text-center">
					<p class="font-weight-bold h1">Tweet<i class="fas fa-at icon--wac  mt-1 ml-2 mb-2"></i><span class="color--blue">cademie</span></p>
				</div>
				<div class="container">
					<p class="font-weight-bold h3 ">See what’s happening in the world right now</p>
					<p class="font-weight-bold mt-4">Join Tweet <span class="color--blue">@cademie</span> today.</p>
				</div>
				<div class="text-center col-md-12 mb-lg-0 mb-md-0 mb-5">
					<form action="inscription.php">
						<button class="btn col-md-12 mt-3 p-1 sign--butt">S'inscrire</button>
					</form>
					<div>
						<form action="connexion.php">
							<button class="btn col-md-12 mt-3 p-1 log--butt">Se connecter</button>
						</form> 
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>