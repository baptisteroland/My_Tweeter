<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Incription</title>
	<meta charset="utf-8">

	
					<link rel="stylesheet" type="text/css" href="css/theme_default/inscription.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/style.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/navbar.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/messagerie.css">
				<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body>
				<div>
					<div class="navbar navbar-light d-lg-block d-md-none d-none">
						<form class="form-inline col-md-10">
							<a href="index.php" class="logo--navbar"><i class="fas fa-at icon--wac mr-2 mt-1 "></i></a>
							<input type="text" name="recherche" placeholder="Recherche Twitter" class="form-control input--search--insc col-md-3 p-1" disabled="disabled">
							<button class="btn butt--connect--insc ml-3 butt--color1 font-weight-bold" disabled="disabled">Se connecter</button>
							<button class="btn butt--connect--insc ml-2 butt--color2 font-weight-bold" disabled="disabled">S'inscrire</button>
						</form>
					</div>
					<hr class="mt-0 bg-dark">
				</div>
				<div class="container col-lg-4 mt-5 contain--form--insc p-3 pb-5">
					<form method="POST" action="../modele/subscrire.php">
						<div class="float-right">
							<button class="btn butt-suivant" type="submit">suivant</button>
						</div>
						<h1 class="mt-5 h3 ml-3">Créer votre compte</h1>
						<div class="mt-3">
							<input type="text" name="username" class="form-control col-md-11 container mt-4 p-2" placeholder="Pseudo...">
							<input type="text" name="lastname" class="form-control col-md-11 mt-4 container p-2" placeholder="Nom...">
							<input type="text" name="firstname" class="form-control col-md-11 container mt-4 p-2" placeholder="Prénom...">
							<input type="email" name="email" class="form-control col-md-11 container mt-4 p-2" placeholder="Email...">
							<input type="password" name="password" class="form-control col-md-11 container mt-4 p-2" placeholder="Mot de passe...">
							<input type="password" name="confirmPass" class="form-control col-md-11 container mt-4 p-2" placeholder="Confirmer Mot de passe...">
						</div>
					</form>
				</div>
			</body>
			</html>