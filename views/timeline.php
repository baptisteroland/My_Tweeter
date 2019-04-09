			<?php
			if(!isset($user))
			{
				include('../modele/tweet.php');
				extract($_SESSION);
				$user = new Modele();
			}
			include('../controller/tools.php'); 
			$tweet_followers = $user->getFollowing($_SESSION['id_user']);
			$all_tweet = $user->displayAllTweet($_SESSION['id_user'], $tweet_followers);


				//var_dump($tweet);
			?>

			<!-- Div qui contiendra les tweet ! -->
			<div id="tweet_result" style="display: none;">
				Tweet posté
			</div>
			<div  id="new_tweet">


				<?php  
				$tri = $user->tri();
				//var_dump($tri);
				foreach($tri as $t):


					if(isset($t['id_tweet']))
					{
						$all_media = $user->displayImg($t['id_tweet']);
						$infos = $user->getInfosUsers($t['id_user_tweet']);
					//$content = $user->transformString($content_tweet);
						$a = $user->getInfosTweet($t['id_tweet']);
						/* on récupere tous les infos des tweet envoyé (arra)y */
						$tweet = $user->getInfosTweet($t['id_tweet']);
						foreach($tweet as $content):
							foreach ($infos as $infos_user):
			 	//var_dump($tweet);
								?>
								<div class="contain--tweet">
									<div class="form-inline ml-3 pic--center--page">
										<?php if($infos_user['avatar'] !== null)
										{
											?><img src="../controller/img/<?= $infos_user['avatar'] ?>"  class="float-left" width="40" height="40" alt="profil"><?php 
										}
										else {
											?>
											<img class="float-left" src="img/user.png" width="40" height="40" alt="image de profil">
										<?php  } ?>
										<p class="ml-2 mb-0 font-weight-bold "><?= $user->transformString($infos_user['username']) ?> <?= $user->transformString("@".$infos_user['username']) ?></p>
										<p class="mt-3 ml-2"><?= "(Posté le ".$content['date_tweet'].")" ?></p>
									</div>		

									<?php foreach($all_media as $img): ?> 
										<img src="<?= "../controller/img/".$img['name_media'] ?>" alt="profil_image" width="500"> 
									<?php endforeach; ?>

									<div class="mt-3 container mb-4 block--string">
										<p> <?= $user->transformString($content['content_tweet']) ?></p>
									</div>
									<div class="form-inline ml-3">
											<?php 
											$count_com = $user->countCom($content['id_tweet']); 
											foreach ($count_com as $key):
											endforeach;
											?>
										<button type="submit" class="far fa-comment"></button>
										<span class="ml-1"><?= $key['COUNT(id_comment)'] ?></span>
										<div>
										</div>


										<!-- <i class="fas fa-retweet ml-5"></i> -->
										<form action="../controller/functions.php" method="post">
											<?php 
											$count_retweet = $user->countRetweet($content['id_tweet']); 
											foreach ($count_retweet as $key):
											endforeach;
											?>
											<input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
											<input type="hidden" name="id_tweet" value="<?= 	$content['id_tweet'] ?>">
											<button type="submit" class="fas fa-retweet ml-5 btn" name="retweet" value=""></button>
										</form>

										<span class="ml-1"><?= $key['COUNT(id_retweet)'] ?></span>

										<!-- <i class="far fa-heart ml-5"></i> -->

										<form action="../controller/functions.php" method="post">
											<?php 
											$count_like = $user->countLike($content['id_tweet']); 
											foreach ($count_like as $key):
											endforeach;
											?>
											<input type="hidden" name="id_user" value="<?= $id_user ?>">
											<input type="hidden" name="id_tweet" value="<?= $content['id_tweet'] ?>">
											<button type="submit" name="like"  class="far fa-heart ml-5 btn" value=""></button>
										</form>
										<span class="ml-1"><?= $key['COUNT(id_like)'] ?></span>



										<form action="newmessage.php" method="get">
											<input type="hidden" name="id_user" value ="<?= $infos_user['id_user'] ?>">
											<input type="hidden" name="destinataire" value ="<?= $infos_user['email'] ?>">
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
										$comment = $user->getComment($content['id_tweet']);
										foreach($comment as $com):
											$calcul = new tools();
											$result = $calcul->calculate_days(date('d-m-Y'), substr($com['date_comment'], 0, 10));

											$infos_user = $user->getInfosUsers($com['id_user']);
											foreach ($infos_user as $infos):
												?>
												<p class="mb-0 ml-5 day--comm"><?= $result ?></p>
												<div class="col-9">
													<p class="p-1 pl-3 ml-1 answer block--string"><span class="text-primary mr-2 d-flex ml-1"><?= $user->transformString(" @".$infos['username']) ?></span><?= $user->transformString($com['content_comment']) ?></p>
												</div>
												<?php 
											endforeach; endforeach; ?>
											<hr class="bg-light">
											<form action="../controller/functions.php" method="post" class="form-inline">
												<input type="hidden" name="id_user" value="<?= $id_user ?>">
												<input type="hidden" name="id_tweet" value="<?= $content['id_tweet'] ?>">
												<input type="text" name="content" value="" placeholder="Répondre..." class="col-lg-10 ml-2 form-control">
												<button type="submit" name="comment"><i class="fas fa-arrow-circle-up sendrep"></i></button>
											</form>
										</div>
										<hr>
									<?php  endforeach; 
								endforeach;
							}
							elseif(isset($t['id_retweet']))
							{
								/* on récupere tous les infos des retweet posté (arra)y2 */
								$retweet = $user->getInfosTweet($t['id_retweet']);
								foreach($retweet as $infos):
									/* on récupere tous les infos de la table retweet (arra)y2 */
									$inf = $user->getRetweet($t['id_retweet']);
									foreach($inf as $users):
									endforeach;
									/* on récuperele retweeter pour afficher son nom (arra)y2 */
									$infos_t = $user->getInfosUsers($users['id_user']);
									$all_media = $user->displayImg($users['id_tweet']);
									$infos_r = $user->getInfosUsers($infos['id_user']);
									foreach ($infos_r as $retweeter):
									endforeach;	
									foreach($infos_t as $in):
										?>
										<div>
											<div class="form-inline ml-3 pic--center--page">
												<?php if($in['avatar'] !== null)
												{
													?><img src="../controller/img/<?= $in['avatar'] ?>"  class="float-left" width="40" height="40" alt="profil"><?php 
												}
												else 
												{
													?>
													<img class="float-left" src="img/user.png" width="40" height="40" alt="image de profil">
												<?php  } ?> 
												<p class="ml-2 mb-0 font-weight-bold "><?= $user->transformString($in['username']) ?> <?= $user->transformString('@'.$in['username'] . " a retweeté :") ?></p>
												<p class="mt-3 ml-2"><?= "(Posté le ".$users['date_retweet'].")" ?></p>
											</div>


									<?php foreach($all_media as $img): ?> 
										<img src="<?= "../controller/img/".$img['name_media'] ?>" alt="profil_image" width="500"> 
									<?php endforeach; ?>
											
											<div class="mt-3 container mb-4">
												<p> <?= $user->transformString('@'.$retweeter['username'])." ".$user->transformString($infos['content_tweet'])."<br>" ?></p>
												</div> 
												<hr class="bg-light"> <?php
											endforeach;
										endforeach;
								//var_dump($infos_retweet);
									}?> <?php 
								endforeach; ?>
								<!-- fin de la div qui contient le tweet (div a boucler) -->
							</div>


									<?php if(count($tri) == 0)
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