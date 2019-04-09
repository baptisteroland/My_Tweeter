<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">

	<?php 
	include('../modele/tweet.php'); 
	include('check_conn.php'); 
	include('../controller/tools.php'); 
	extract($_SESSION);
	extract($_GET);
	$user = new Check();	
	$modele = new Modele();
	$infos = $modele->getInfosUsersbyName($pseudo);
	//var_dump($infos);
	foreach($infos as $profil):
	endforeach;

	extract($profil);	


	$following = $modele->getFollowing($_SESSION['id_user']);
	//var_dump($following);
	$follow = false;
	foreach($following as $user_followed):
		if($user_followed['id_followed'] !== $profil['id_user'])
		{
			//echo "no";
		}
		else
		{
			//echo"yes";
			$follow= true;
		}
	endforeach;
	//var_dump($follow);

	$count_nbr_tweet = $modele->countTweet($profil['id_user']);
	foreach ($count_nbr_tweet as $nbr_tweet):
	endforeach;
	$count_following = $modele->countFollowing($profil['id_user']);
	foreach ($count_following as $followed):
	endforeach;
	$count_followers = $modele->countFollowers($profil['id_user']);
	foreach ($count_followers as $followers):
	endforeach;

	//var_dump($_GET);

	if ($theme == "#C7C3B4")
		{ ?>
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/profil_tweet.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
					<?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body class="body--color">
				<?php include('navbar.php'); ?>
				
				<!-- Div contenant le header de la page -->

				<!-- IMAGE PROFIL -->
				<div class="contain--profil--pic">
					<div class="form--profil--pic text-center pic--center--page">
					<?php if ($profil['avatar'] !== null) {
						?> <img src="../controller/img/<?= $profil['avatar'] ?>" width="200" height="200" alt="profil"> <?php
					} 
					else {
						?>
						<img class="float-left" src="img/user.png" width="200" height="200" alt="profil">
					<?php  } ?>
					<form class="form-inline" method="post" action="../controller/functions.php" id="form_tweet" enctype="multipart/form-data" >
						<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
					</form> 
				</div>
				</div>
				<!-- IMAGE PROFIL -->
				<!-- <img class="cover--picture" src="img/westcoastlogo.jpg"> -->
				<div class=" bar--count--tweet">
					<div class="text-center p-0">
						<nav class="navbar-expand-lg navbar-light bg-light">
							<div class="collapse navbar-collapse container col-md-2" id="navbarNav">
								<ul class="navbar-nav countbar p-2">
									<li class="nav-item">
										<a class="" href="profil_tweet.php">Tweets<br><?= $nbr_tweet['COUNT(id_tweet)'] ?></a>
									</li>
									<li class="nav-item ml-5">
										<a  href="profil_following.php">Following <br><?= $followed['COUNT(id_followed)'] ?></a>
									</li>
									<li class="nav-item ml-5">
										<a href="profil_followers.php">Followers<br><?= $followers['COUNT(id_follower)'] ?></a>
									</li>
								</ul>
								<div class="col-md-12 ml-5">
									<form action="../controller/functions.php" method="post" accept-charset="utf-8">
										<input type="hidden" name="id_followed" value="<?= $profil['id_user'] ?>">
										<?php
										if($follow !== true)
										{
											?>
											<button type="submit" name="follow" class="butt--edit p-1 pr-2 pl-2 float-right">S'abonner</button>
											<?php 
										}
										else { ?>
											<button class="butt--edit p-1 pr-2 pl-2 float-right" name="follow">Se désabonner</button>
											<?php
										} ?>
									</form>
								</div>
							</div>
						</nav>
					</div>
				</div>




				<div class="container contain--actu">
					<!-- div qui contient tout ce qu'il y a dans la colonne de gauche de la page -->
					<div class="col-md-3 p-0 div--profile1 float-lg-left">
						<div class="contain--profile">
							<div class="bg-light p-3 link--profil">
								<p class="mt-3 mb-0 font-weight-bold h4"><?= $profil['username'] ?></p>
								<p class="h4 mb-4">@<?= $profil['username'] ?></p>
								<p class="resume--text">West coast, plus que deter on va tout niquer.</p>
								<a href="#"><p class=" blue--link">Paris, France</p></a>
								<p class="m-0 resume--text">Inscrit en février 2015</p>
								<p class="m-0 resume--text">Né le 28 septembre 1996</p>
								<a href="#"><p class="mt-3 blue--link mb-0">Dernières photos</p></a>
							</div>
						</div>
			<!-- <div class="p-3 mt-3 contain--link--left">
				<a href="actualite.php">Accueil  ></a>
				<hr>
				<a href="profil_tweet.php">Mon compte ></a>
				<hr>
				<a href="modif_profil.php">Paramètre ></a>
			</div> -->
		</div>
		<!-- Div qui contiendra les tweet ! -->
		<div class="col-md-6 ml-3 contain--modif p-2 mb-5">

			<!-- debut du tweet (div a boucler) -->
			<?php $all_tweet = $modele->getAllTweet($profil['id_user']);

			foreach ($all_tweet as $tweet): 
						$all_media = $user->displayImg($tweet['id_tweet']);
				//var_dump($tweet);?>
				<div class="contain--tweet ">
					<div class="form-inline ml-3 pic--center--page">
						<?php if($profil['avatar'] !== null)
						{
							?><img src="../controller/img/<?= $profil['avatar'] ?>"  class="float-left" width="40" height="40" alt="profil"><?php 
						}
						else {
							?>
							<img class="float-left" src="img/user.png" width="40" height="40">
						<?php  } ?>
						<p class="ml-2 mb-0 font-weight-bold "><a class="user--pseudo" href=""><?= $profil['username'] ?></a><a class=" ml-2 pseudo--link" href="#">@<?= $profil['username'] ?></a></p>
					</div>
					
									<?php foreach($all_media as $img): ?> 
										<img src="<?= "../controller/img/".$img['name_media'] ?>" alt="profil_image" width="500"> 
									<?php endforeach; ?>
					<div class="mt-3 container mb-4 block--string">
						<p><?= $user->transformString($tweet['content_tweet']) ?></p>
					</div>

					<div class="form-inline ml-3">
						<button type="submit" class="far fa-comment"></button>
						<span class="ml-1"></span>
						<div>
						</div>


						<!-- <i class="fas fa-retweet ml-5"></i> -->
						<form action="../controller/functions.php" method="post">
							<?php 
							$count_retweet = $user->countRetweet($tweet['id_tweet']); 
							foreach ($count_retweet as $key):
							endforeach;
							?>
							<input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
							<input type="hidden" name="id_tweet" value="<?= 	$tweet['id_tweet'] ?>">
							<button type="submit" class="fas fa-retweet ml-5 btn" name="retweet" value=""></button>
						</form>

						<span class="ml-1"><?= $key['COUNT(id_retweet)'] ?></span>

						<!-- <i class="far fa-heart ml-5"></i> -->

						<form action="../controller/functions.php" method="post">
							<?php 
							$count_like = $user->countLike($tweet['id_tweet']); 
							foreach ($count_like as $key):
							endforeach;
							?>
							<input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
							<input type="hidden" name="id_tweet" value="<?= $tweet['id_tweet'] ?>">
							<button type="submit" name="like"  class="far fa-heart ml-5 btn" value=""></button>
						</form>
						<span class="ml-1"><?= $key['COUNT(id_like)'] ?></span>



						<form action="newmessage.php" method="get">
							<input type="hidden" name="id_user" value ="<?= $_SESSION['id_user'] ?>">
							<input type="hidden" name="destinataire" value ="<?= $profil['email'] ?>">
							<button type="submit">
								<i class="far fa-envelope ml-5 btn "></i></button>
							</form>
							<!-- <span class="ml-1">?</span> -->
							<?php //var_dump($followers); ?>
						</div>
					</div>
					<div>
						<hr class="bg-light">
						<?php 
						$user = new User();
						$comment = $user->getComment($tweet['id_tweet']);
						foreach($comment as $com):
							$calcul = new tools();
							$result = $calcul->calculate_days(date('d-m-Y'), substr($com['date_comment'], 0, 10));

								$infos_user = $user->getInfosUsers($com['id_user']);
								foreach ($infos_user as $infos):
									?>
									<p class="mb-0 ml-5 day--comm"><?= $result ?></p>
									<div class="col-9 block--string">
										<p class="p-1 pl-2 ml-3 answer"><span class="text-primary mr-2"><?= $infos['username']." @".$infos['username'] ?></span><?= $com['content_comment'] ?></p>
									</div>
									<?php 
								endforeach; endforeach; ?>
								<hr class="bg-light">
								<form action="../controller/user.php" method="post" class="form-inline">
									<input type="hidden" name="id_user" value="<?= $id_user ?>">
									<input type="hidden" name="id_tweet" value="<?= $tweet['id_tweet'] ?>">
									<input type="text" name="content" value="" placeholder="Répondre..." class="col-lg-10 ml-2 form-control">
									<button type="submit" name="comment"><i class="fas fa-arrow-circle-up sendrep"></i></button>
								</form>
							</div>
							<hr>
						<?php endforeach; ?>
						<!-- fin du tweet (div a boucler) -->

						<!-- message d'erreur -->
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
</div>
				</body>
				</html>
