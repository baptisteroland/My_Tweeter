<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion</title>
	<meta charset="utf-8">
					<link rel="stylesheet" type="text/css" href="css/theme_default/connexion.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/messagerie.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">	
				<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
			</head>
			<body class="body--color">
				<header>
					<div class="form-inline container col-md-6">
						<a href="index.php"><i class="fas fa-at mr-2 mt-1 logo--site"></i></a>
						<nav>
							<ul class="form-inline list-unstyled mt-2">
								<li class="surlign"><a href="index.php">Accueil</a></li>
								<li class="ml-4"><a href="">À propos</a></li>
							</ul>
						</nav>
					</div>
					<hr class="mt-0">
				</header>
				<div class="container col-lg-6 col-md-6 col-sm-12">
					<div class="container contain--form--connect">
						<div class="col-md-7 container">
							<h2>Se connecter a twitter</h2>
							<form method="post" action="../modele/login.php">
								<input type="email" name="email" placeholder="Email..." class="form-control mt-4 col-md-10 p-1">
								<div>
									<input type="password" name="password" placeholder="Mot de passe..." class="form-control mt-3 p-1 col-md-10">
								</div>
							<div class="col-md-7">
								<button class="col-lg-5 col-md-7 p-1 mt-4 butt--connect" type="submit">Se connecter</button>
							</div>
							</form>
						</div>
						<div class="col-md-7 container mt-3 link--insc">
							<p class="end--form">Nouveau sur Twitter ? <a href="inscription.php">S'inscrire maintenant >></a></p>
						</div>
					</div>
				</div>
			</body>
			</html>