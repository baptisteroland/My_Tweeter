<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Modification</title>
	<meta charset="utf-8">

	<?php 
	include('../modele/tweet.php');
	include('check_conn.php');  
	extract($_SESSION);
	$user = new Check();
	$infos = $user->getInfosUsers($_SESSION['id_user']); 
	foreach ($infos as $inf):
	endforeach;
	extract($inf);
	if ($theme == "#C7C3B4")
		{ ?>

			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css" title="switch_theme">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/style.css" title="switch_theme">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/navbar.css" title="switch_theme">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css" title="switch_theme">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/messagerie.css" title="switch_theme"> 
			<?php
		} 
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css" title="switch_theme">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/style.css" title="switch_theme">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/navbar.css" title="switch_theme">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css" title="switch_theme">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/messagerie.css" title="switch_theme"> 
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css" title="switch_theme">
					<link rel="stylesheet" type="text/css" href="css/theme_default/style.css" title="switch_theme">
					<link rel="stylesheet" type="text/css" href="css/theme_default/navbar.css" title="switch_theme">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css" title="switch_theme">
					<link rel="stylesheet" type="text/css" href="css/theme_default/messagerie.css" title="switch_theme"><?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
				<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
			</head>
			<body class="pb-lg-5 body--color">
				<?php include('navbar.php'); ?>
				<div class="container contain--actu mb-3">
					<div class="col-lg-3 col-md-4 col-sm-12 p-0 div--profile1 float-lg-left d-lg-block d-md-block d-none">
						<div class="contain--profile">				
							<div class="p-2 div--profile2 text-center">
					<?php if ($avatar !== null) 
					{
						?> <img src="../controller/img/<?= $avatar ?>" width="130" height="130" alt="profil"> <?php
					} 
					else
						{?>
							<img src="img/user.png" width="130" height="130" alt="users picture">
						<?php }	?>
					</div>
							<div class="text-center bg-light p-5 link--profil">
								<p class="font-weight-bold mb-0 p-0 h3 link--username"><a href="profil_tweet.php"><?= $username ?></a></p>
								<p class="font-weight-bold mb-0"><a href="profil_tweet.php">@<?= $username ?></a></p>
							</div>
						</div>
					</div>

					<div class="col-md-6 ml-3 contain--modif p-2">
						<div class="p-3">
							<p class="h4 font-weight-bold">Account</p>
						</div>
						<hr class="mt-0">
						<div class="p-2">
							<form method="POST" action="../modele/profil_update.php">
								<label for="user">Username :</label>
								<input type="text" name="username" placeholder="Username" id="user" class="form-control" value="<?= $username ?>">
								<label class="mt-4" for="email">Email :</label>
								<input type="email" name="email" placeholder="Email" id="email" class="form-control" value="<?= $email ?>">
								<input type="submit" name="profil_update" value="Modifier" class=" mt-3 butt--modif">
							</form>
						</div>
						<hr>
						<div class="p-2">
							<p class="h4 font-weight-bold">Confidentialité</p>
							<div>
								<form action="../modele/profil_update.php" method="POST">
									<label class="mt-4" for="actuelpass">Mot de passe actuel :</label>
									<input type="password" name="old_password" id="actuelpass" class="form-control">
									<label class="mt-4" for="new">Nouveau mot de pass :</label>
									<input type="password" name="new_password" id="new" class="form-control">
									<label class="mt-4" for="confirm">Confirmation mot de passe : </label>
									<input type="password" name="confirm_password" id="confirm" class="form-control">
									<input type="submit" name="password_update" value="Modifier" class=" mt-3 butt--modif">
								</form>
							</div>
							<hr>
							<div class="p-2">
								<p class="h4 font-weight-bold">Thèmes</p>
							</div>
							<div class="p-2 text-center mt-2 mb-5">
								<form action="../controller/theme.php" method="post" accept-charset="utf-8">

									<select name="theme" id="select" class="p-2 col-lg-4">
										<option value="css/theme_default/modif_profil">Default</option>
										<option value="css/theme_silver/modif_profil">Silver</option>
										<option value="css/theme_pink/modif_profil">Pink</option>
									</select>
									<div class="mt-2">
										<input type="submit" name="change_theme" value="Confirmer" class="p-1 sub--color">
									</div>
								</form>
							</div>
							<hr>
							<div class="p-2">
								<p class="h4 font-weight-bold">Désactivation</p>
							</div>
							<div>
								<form action="../modele/profil_update.php" method="POST">
									<label class="mt-4" for="pass">Mot de passe : </label>
									<input type="password" name="password" id="pass" class="form-control">
									<input type="submit" name="desactive" value="Désactivation du compte" class=" mt-5 butt--modif">
									<p class="p-2 text-justify h6 mt-2 text--border">En désactivant votre compte, vous désactiver toutes les notifications et toutes possibilitées de contact avec vos suiveurs.</p>
								</form>
							</div>	
						</div>
					</div>
				</div>
				<script>
					$(function () {
						$('#select').change(function () {
							changeTheme($(':selected').val());
						});
					});

					function changeTheme(theme) {
						var stylshit = $('[title="switch_theme"]');
						stylshit.attr('href',''+theme.toLowerCase()+'.css');
        //alert(stylshit.attr('href'));
    }
</script>
</body>
</html>
