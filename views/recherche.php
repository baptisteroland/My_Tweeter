<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Recherche Utilisateur</title>
	<meta charset="utf-8">

	<?php 
	include('../modele/tweet.php');
	include('../controller/tools.php');
	include('check_conn.php'); 
	extract($_SESSION);
	$user = new Modele();
	$infos = $user->getInfosUsers($_SESSION['id_user']); 
	foreach ($infos as $inf):
	endforeach;
	$following = $user->getFollowing($_SESSION['id_user']);
	foreach ($following as $followed): 
	endforeach;
	extract($inf);



	if ($theme == "#C7C3B4")
		{ ?>
			<link rel="stylesheet" type="text/css" href="css/theme_silver/recherche.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_following.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/recherche.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_following.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/recherche.css">
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

				//var_dump($_GET);
				extract($_GET);
				if($tag == "")
				{
					$_SESSION['error'] = "Vous devez rentrez quelque chose.";
					include('../views/error.php');
				}
				$check_hash = strstr($tag, '#');
				$check_at = strstr($tag, '@');
				if($check_hash !== false)
				{
					$search = new Search();
					$tools = new tools();
					$new_search = $tools->transformString($tag);
					preg_match_all('/#(\w+)/', $new_search, $tag);
					$result = $search->searchHashtag($tag);
					$category = "Tag";
				}
				else
				{
					$search = new Search();
					$result=$search->searchProfil($_GET['tag']);
					$category = "Profil";
				}
				$count = count($result);
				if($count>0)
				{
					$count = $count." résultats";
				}
				else
				{

					$count = $count." résultat";?>
					<div class=" container contain--tweet">
						<div class="text-center">
							<i class="fas fa-exclamation-triangle warning--icone"></i>
						</div>
						<div class="mt-3 container mb-4 text-center">
							<p class="font-weight-bold h4">Aucun résultat</p>
						</div>
					</div>
					<?php
				}?>
				<!-- div qui contient les utilisateurs -->
				<div class="container div--title mb-0 text-center mt-sm-5">
					<p class="h3 font-weight-bold">Résultat de votre recherche de <?= $category ." : ".  $count ?><p>
					</div>
					<div class="container contain--user">
						<div class="row ml-lg-4 col-md-12 contain--following text-center">
							<!-- block-user (boucler sur ce block pour afficher tout les users)-->
							<?php 
							foreach ($result as $key): 
								if(!isset($key['name_hashtag']))
								{
									extract($key);
									?>
									<div class="col-lg-3 col-md-6 bg-light m-2 block--user p-0 pb-3 ml-lg-5">

										<div class="pic--couv--user--block p-2 pb-3">	
											<!-- IMAGE PROFIL -->
											<?php if ($avatar !== null) 
											{
												?> <img src="../controller/img/<?= $avatar ?>" width="80" height="80" alt="profil"  class="mt-2 user--logo"> <?php
											} 
											else
												{?>
													<img src="img/user.png" width="80" height="80" class="mt-2 user--logo" alt="image de profil">
												<?php }	?>
											</div>
											<div>
												<p class="mb-0 mt-4 text-dark font-weight-bold ml-2 h4"><?=  $user->transformString($username) ?></p>
												<p class="text-light ml-2 text-dark"><?=  $user->transformString("@".$username) ?></p>
											</div>
											<div class="p-2 pt-0 m-0">
												<p class="mb-0 ">On aurait du rentrer des text mais azy la base de donnée elle est flinguer...</p>
											</div>
											<div class="d-block text-right float-right m-2">
												<form action="newmessage.php" method="post">
													<input type="hidden" name="id_user" value ="<?= $id_user ?>">
													<input type="hidden" name="destinataire" value ="<?= $key['email'] ?>">
													<button type="submit">
														<i class="far fa-envelope message--icon"></i></button>
													</form>
												</div>
											</div>
										<?php }

										else
										{
											$tweet = $user->getIdTweetByTag($key['id_hashtag']);
											foreach($tweet as $tweeter):
												$infos_tweet = $user->getInfosTweet($tweeter['id_tweet']);
												foreach($infos_tweet as $infos):
													$infos_users = $user->getInfosUsers($infos['id_user']);
													foreach($infos_users as $users):
														?>
														<div class="col-md-3 bg-light m-2 block--user p-0 pb-3 ml-5">

															<div class="pic--couv--user--block p-2 pb-3">	
																<!-- IMAGE PROFIL -->
																<?php if ($users['avatar'] !== null) 
																{
																	?> <img src="../controller/img/<?= $users['avatar'] ?>" width="80" height="80" alt="profil"  class="mt-2 user--logo"> <?php
																} 
																else
																	{?>
																		<img src="img/user.png" width="80" height="80" class="mt-2 user--logo">
																	<?php }	?>
																</div>
																<div>
																	<p class="mb-0 mt-4 text-dark font-weight-bold ml-2 h4"><?=  $user->transformString($users['username']) ?></p>
																	<p class="text-light ml-2 text-dark"><?=  $user->transformString("@".$users['username']) ?></p>
																</div>
																<div class="p-2 pt-0 m-0">
																	<p class="mb-0 "><?= $user->transformString($infos['content_tweet']) ?></p>
																</div>
																<div class="d-block text-right float-right m-2">
																	<form action="newmessage.php" method="post">
																		<input type="hidden" name="id_user" value ="<?= $_SESSION['id_user'] ?>">
																		<input type="hidden" name="destinataire" value ="<?= $users['id_user'] ?>">
																		<button type="submit">
																			<i class="far fa-envelope message--icon"></i></button>
																		</form>
																	</div>
																	</div> <?php
																endforeach;
															endforeach;
														endforeach;
													}
												endforeach; ?>
												<!-- fin du block user -->
											</div>
										</div>
									</body>
									</html>