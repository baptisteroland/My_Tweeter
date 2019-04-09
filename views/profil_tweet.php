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
				<div>
					
				<!-- IMAGE PROFIL -->
				<div class="contain--profil--pic">
					<form class="form--profil--pic text-center" method="post" action="../controller/functions.php" id="form_tweet" enctype="multipart/form-data" >
						<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						<label for="testmodif" class="ml-2 mt-3 choose--img"><?php if ($avatar !== null) {
							?> <img src="../controller/img/<?= $avatar ?>" width="200" height="200" alt="profil"><?php
						} else {  ?> 
							<img src="img/user.png" width="200" height="200" alt="default pict user">
							<?php } ?></label>
							<div class="ml-5">
							<input type="file" name="image_profil" class="modif--visu--input mt-2 ml-5 d-none" id="testmodif" /></div>
							<button class=" my-2 my-sm-0 p-sm-1 butt--img--change font-weight-bold" name="upload_img_profil" type="submit">Confirm Image</button>
						</form>
				<!-- <img class="cover--picture" src="img/westcoastlogo.jpg"> -->
					</div>
					<!-- IMAGE PROFIL -->
				</div>
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
									<a class="butt--edit p-1 pr-2 pl-2 float-right" href="modif_profil.php">Edit profil</a>
								</div>
							</div>
						</nav>
					</div>
				</div>




					<div class="container contain--actu mjtop--contain">
						<!-- div qui contient tout ce qu'il y a dans la colonne de gauche de la page -->
						<div class="col-md-3 p-0 div--profile1 float-lg-left d-lg-block d-md-block d-sm-none d-xs-none">
							<div class="contain--profile">
								<div class="bg-light p-3 link--profil">
									<p class="mt-3 mb-0 font-weight-bold h4"><?= $username ?></p>
									<p class="h4 mb-4">@<?= $username ?></p>
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
		<div class="col-lg-6 col-md-10 col-sm-12 ml-3 contain--modif p-2 mb-5">

			<!-- debut du tweet (div a boucler) -->
			<?php 
			$all_tweet = $user->getAllTweet($_SESSION['id_user']);

			//var_dump($all_tweet);
			foreach ($all_tweet as $tweet):
						$all_media = $user->displayImg($tweet['id_tweet']);
			?>
			<div class="contain--tweet ">
				<div class="form-inline ml-3 pic--center--page">
					<?php if ($avatar !== null) 
						{
							?> <img src="../controller/img/<?= $avatar ?>"  class="mr-2 mb-1" width="40" height="40" alt="profil"> <?php
						} 
						else
							{?>
								<img src="img/user.png"  class="mr-2 mb-1" width="40" height="40" alt="users picture">
							<?php }	?>
					<p class="ml-2 mb-0 font-weight-bold "><a class="user--pseudo" href=""><?= $username ?></a><a class=" ml-2 pseudo--link" href="#">@<?= $username ?></a></p><p class="mt-3 ml-2"><?= "(Posté le ".$tweet['date_tweet'].")" ?></p>
				</div>


									<?php foreach($all_media as $img): ?> 
										<img src="<?= "../controller/img/".$img['name_media'] ?>" alt="profil_image" width="500"> 
									<?php endforeach; ?>
				
				<div class="mt-3 container mb-4">
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
											<input type="hidden" name="id_user" value="<?= $id_user ?>">
											<input type="hidden" name="id_tweet" value="<?= $tweet['id_tweet'] ?>">
											<button type="submit" name="like"  class="far fa-heart ml-5 btn" value=""></button>
										</form>
										<span class="ml-1"><?= $key['COUNT(id_like)'] ?></span>



								
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
												<div class="col-9">
													<p class="p-1 pl-2 ml-3 answer block--string"><span class="text-primary mr-2"><?= $infos['username']." @".$infos['username'] ?></span><?= $com['content_comment'] ?></p>
												</div>
												<?php 
											endforeach; endforeach; ?>
											<hr class="bg-light">
											<form action="../controller/functions.php" method="post" class="form-inline">
												<input type="hidden" name="id_user" value="<?= $id_user ?>">
												<input type="hidden" name="id_tweet" value="<?= $tweet['id_tweet'] ?>">
												<input type="text" name="content" value="" placeholder="Répondre..." class="col-lg-10 ml-2 form-control">
												<button type="submit" name="comment"><i class="fas fa-arrow-circle-up sendrep"></i></button>
											</form>
										</div>
										<hr>
			<?php endforeach; ?>
			<!-- fin du tweet (div a boucler) -->

		<?php if(count($all_tweet) == 0)
		{ ?>
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
			<?php } ?>
		</div>
			</div>


	</body>
	</html>
