<!DOCTYPE html>
<html>
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
	$user = new Modele();
	$count_nbr_tweet = $user->countTweet($_SESSION['id_user']);
	foreach ($count_nbr_tweet as $nbr_tweet):
	endforeach;
	$count_following = $user->countFollowing($_SESSION['id_user']);
	foreach ($count_following as $followed):
	endforeach;
	$count_followers = $user->countFollowers($_SESSION['id_user']);
	foreach ($count_followers as $followers):
	endforeach;
	if ($theme == "#C7C3B4")
		{ ?>
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/profil_tweet.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
					<?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body class="body--color">
				<?php  include('navbar.php'); ?>
				<!-- Div contenant le header de la page -->

				
				<?php include('header_profil.php'); ?>


				<!-- Div qui contiendra les tweet ! -->
				<div class="col-md-6 ml-3 contain--modif p-2">
					<!-- debut tweet (div a boucler) -->
					<?php 

					$all_tweet = $user->getAllTweet($_SESSION['id_user']);
					foreach ($all_tweet as $tweet):
						$retweet = $user->getRetweet($tweet['id_tweet']);
						foreach ($retweet as $key):
							$infos = $user->getInfosUsers($key['id_user']);
							foreach($infos as $retweet_user):
								?>
								<div class="contain--tweet ">
									<div class="form-inline ml-3  pic--center--page">
										<?php if ($retweet_user['avatar'] !== null) 
										{
											?> <img src="../controller/<?= $retweet_user['avatar'] ?>"  class="mr-2 mb-1" width="40px" height="40" alt="profil"> <?php
										} 
										else
											{?>
												<img src="img/user.png"  class="mr-2 mb-1 " width="40" height="40" alt="users picture">
											<?php }	?>								
											<p class="ml-2 mb-0 font-weight-bold "><a class="user--pseudo" href=""><?= '@'.$retweet_user['username'] ?></a><a class=" ml-2 pseudo--link" href="#"></a>a retweeté votre tweet</p>
										</div>
										<div class="mt-3 container mb-4">
											<p><?= $tweet['content_tweet'] ?></p>
										</div>
										<div class="form-inline ml-3">
											<i class="far fa-envelope"></i>
										</div>
									</div>
									<hr>	
									<!-- fin du tweet (div a boucler) -->
								<?php endforeach; endforeach; endforeach; ?>

								<!-- message d'erreur !! -->
								<div class="contain--tweet">
									<div class="text-center">
										<i class="fas fa-exclamation-triangle warning--icone"></i>
									</div>
									<div class="mt-3 container mb-4 text-center">
										<p class="font-weight-bold">Aucun résultat</p>
									</div>
								</div>
								<!-- fin du message d'erreur  -->
							</div>

							<!-- Div qui contient toute la colonne de droite -->
							<div class="float-lg-left col-md-3 ml-3 p-0 text-center contain--all--count">
								<div class="contain--count--tweet bg-light p-2">
									<p class="h4 font-weight-bold ">Tweet<i class="fas fa-star ml-2 star--icone"></i></p>
									<i class="fas fa-chevron-circle-down arrow--down mt-2"></i>
									<p class="text-danger">Afficher meilleurs Tweet</p>


									<!-- Afficher les tweets les plus populaires -->
								</div>

							</div>

						</body>
						</html>
