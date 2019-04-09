<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	
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
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_following.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">

			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_following.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/profil_tweet.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/profil_following.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
					<?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body class="body--color">
				<?php 
				include('navbar.php');

				$user = new Modele();
				$following = $user->getFollowing($_SESSION['id_user']);
				extract($_SESSION);

				$get_nbr_tweet = $user->countTweet($_SESSION['id_user']);
				foreach ($get_nbr_tweet as $nbr_tweet):
				endforeach;

				$get_following = $user->countFollowing($_SESSION['id_user']);
				foreach ($get_following as $followed):
				endforeach;

				$get_followers = $user->countFollowers($_SESSION['id_user']);
				foreach ($get_followers as $followers):
				endforeach;
				?>
				<!-- Div contenant le header de la page -->

				<?php include('header_profil.php'); ?>
				
				<!-- Div qui contiendra les tweet ! -->

				<!-- boucler sur cette div pour les utilisateur -->
				<div class="row ml-4 col-md-12 contain--following text-center">
					<?php foreach ($following as $key):
						$infos = $user->getInfosUsers($key['id_followed']);
		foreach ($infos as $followers):		 	//var_dump($following);
		?>
		<div class="col-lg-3 col-md-10 col-sm-12 col-xs-12 bg-light m-2 block--user p-0 pb-3">
			<div class="pic--couv--user--block p-2 pb-3">
				<?php if ($followers['avatar'] !== null) 
				{
					?> <img src="../controller/<?= $followers['avatar'] ?>"  class="ml-2 mr-2 mb-1 user--logo" width="80" height="80" alt="profil"> <?php
				} 
				else
					{?>
						<img src="img/user.png"  class="mr-2 mb-1 ml-2 user--logo" width="80" height="80" alt="users picture">
						<?php }	?>		
						</div>
						<div>
							<p class="mb-0 mt-4 text-dark font-weight-bold ml-2 h4"><?= $user->transformString($followers['username']) ?></p>
							<p class="text-light ml-2 text-dark"><?= $user->transformString("@".$followers['username']) ?></p>
						</div>
						<div class="p-2 pt-0 m-0">
							<p class="mb-0 ">On aurait du rentrer des texte mais azy la base de donnée elle est flinguer...</p>
						</div>
						<div class="d-block text-right float-right m-2">
							<i class="far fa-envelope message--icon"></i>
			        	</div>
					</div>
				<?php  endforeach; endforeach ?>
				<!-- fin de la boucle pour les utilisateur -->

				<!-- message derreur -->
			<!-- <div class=" container contain--tweet">
				<div class="text-center">
					<i class="fas fa-exclamation-triangle warning--icone"></i>
				</div>
				<div class="mt-3 container mb-4 text-center">
					<p class="font-weight-bold h4">Aucun résultat</p>
				</div>
			</div> -->
			<!-- fin du message d'erreur -->
		</div>
	</div>
</body>
</html>

