	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<?php 
	extract($_SESSION);
	$user = new Modele();
	$result = $user->getFollowing($_SESSION['id_user']);

	$infos = $user->getInfosUsers($_SESSION['id_user']); 
	foreach ($infos as $inf):
	endforeach;
	extract($inf);
	if ($theme == "#C7C3B4")
		{ ?>
			<link rel="stylesheet" type="text/css" href="css/theme_silver/navbar.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/navbar.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/navbar.css">
					<?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
				<header class="fixed-top bg-light">
					<div class="container">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<a href="actualite.php" class="color--link h5 m-0"><i class="fas fa-home mr-1"></i>Accueil</a>
							<img src="img/user.png" width="40" alt="users picture" class="ml-2 pictuser d-lg-none d-md-block d-sm-block">
							<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
								<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
									<li class="nav-item active">
										<a class="color--link ml-3 h5" href="notification.php"><i class="fas fa-bell mr-1"></i>Notification</a>
									</li>
									<li class="nav-item active">
										<a class="color--link ml-3 h5" href="messagerie.php"><i class="fas fa-envelope mr-1"></i>Messagerie</a>
									</li>
								</ul>


								<div class="d-lg-block d-md-block d-none">
									<a href="actualite.php"><i class="fas fa-at icon--wac mr-2 mt-1"></i></a>
								</div>
								<form method="get" action="recherche.php" class="form-inline my-2 my-lg-0">						
									<input list="search" class="p-1 pl-2 mr-sm-2 input--search" type="text" name="tag" placeholder="Search">

									<datalist id="search">

										<?php foreach ($result as $key): 
											$infos = $user->getInfosUsers($key['id_followed']);

											?>
											<?php foreach ($infos as $value):  ?>

												<option value="@<?= $value['username']?>">
												<?php endforeach;
												endforeach; ?>

											<?php 	$tweet = $user->getAllTweet($_SESSION['id_user']);
											foreach ($tweet as $value): 
												$inf = $user->getTweetToTag($value['id_tweet']);
												foreach ($inf as $q):
													$tag = $user->getHashtagById($q['id_tag']);
													foreach ($tag as $a):
														?>
														<option value="#<?= $a['name_hashtag']?>">
															<?php 

														endforeach;
														endforeach;
												endforeach; ?>
											</datalist>
											
											<button class="btn my-2 my-sm-0 p-1 pl-2 pr-2 butt--search" name="search" type="submit">Search</button>
											<!-- IMAGE PROFIL -->
											<div class="pic--navbar--page">
												<?php if ($avatar !== null) 
												{
													?> <img src="../controller/img/<?= $avatar ?>" width="40" height="40" alt="profil" class="ml-2 pictuser"> <?php
												} 
												else
													{?>
														<img src="img/user.png" width="40" height="40" alt="users picture" class="ml-2 pictuser">
													<?php }	?>
												</div>	
											</form>
										</div>
									</nav>
								</div>
								<hr class="m-0">
							</header>
							<div class="text-lg-center text-md-right container menu--deroulant col-xs-12 col-sm-12 col-md-7 col-lg-12 fixed-top ">
								<div class="col-lg-2 col-sm-7 col-md-6 text-center font-weight-bold float-right">
									<ul class="list-group">
										<li class="list-group-item color--blue color--deroulant"><a href="actualite.php">Accueil</a></li>
										<li class="list-group-item color--blue color--deroulant"><a href="modif_profil.php">Paramètres</a></li>
										<li class="list-group-item color--blue color--deroulant"><a href="profil_tweet.php">Profil</a></li>
										<li class="list-group-item color--blue color--deroulant"><a href="../modele/logout.php">Deconnexion</a></li>
									</ul>
								</div>
							</div>
							<?php ?>

							<script src="jquery-3.3.1.min.js"></script>
							<script src="menu_deroulant.js"></script>