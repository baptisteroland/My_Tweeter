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
							<input type="file" name="monfichier" class="modif--visu--input mt-2 ml-5 d-none" id="testmodif" /></div>
							
							<button class=" my-2 my-sm-0 p-sm-1 butt--img--change font-weight-bold" type="submit">Confirm Image</button>
						</form>
				<!-- <img class="cover--picture" src="img/westcoastlogo.jpg"> -->
					</div>
					<!-- IMAGE PROFIL -->

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
					<div class="col-md-3 p-0 div--profile1 float-lg-left">
							<div class="contain--profile d-lg-block d-md-none d-none">
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
					</div>

