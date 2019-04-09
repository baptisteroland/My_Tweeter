			<?php
			if(!isset($user))
			{

				include('../modele/tweet.php');
				extract($_SESSION);
			}
				$user = new User();
			$all_tweet = $user->getAllTweet($_SESSION['id_user']);
			foreach($all_tweet as $v):
				$comment = $user->getComment($v['id_tweet']);
				//var_dump($comment);
			endforeach;	
				//var_dump($tweet);
			?>

			<!-- Div qui contiendra les tweet ! -->
			<div id="tweet_result" style="display: none;">
				Tweet posté
			</div>
			<div  id="new_tweet">


				<?php foreach ($all_tweet as $v):
					extract($v);
					$infos_tweet = $user->getInfosTweet($id_tweet);
						$all_media = $user->displayImg($id_tweet);
					foreach ($infos_tweet as $tweet):
				$comment = $user->getComment($id_tweet);
			 	foreach ($comment as $inf_com):
				$infos = $user->getInfosUsers($inf_com['id_user']);
					foreach ($infos as $infos_user):
			 	//var_dump($infos_user);
						?>
						<div class="contain--tweet">
							<div class="ml-3 block--string d-inline">
								<img class="float-left" src="img/user.png" width="40" alt="image de profil">
								<p class="ml-2 mb-0 font-weight-bold"><?= $user->transformString('@'.$infos_user['username']) ?> a commenté "<?= $inf_com['content_comment'] ?>" votre tweet</p><p class="mt-3 ml-2"><?= "(".$inf_com['date_comment'].")" ?></p>
							</div>	

									<?php foreach($all_media as $img): ?> 
										<img src="<?= "../controller/img/".$img['name_media'] ?>" alt="profil_image" width="500"> 
									<?php endforeach; ?>	
							<div class="mt-3 container mb-4">
								<p><?=$tweet['content_tweet'] ?></p>
								<p></p>
							</div>
							<div class="form-inline ml-3">
		
								<form action="newmessage.php" method="get">
									<input type="hidden" name="id_user" value ="<?= $infos_user['id_user'] ?>">
									<input type="hidden" name="destinataire" value ="<?= $infos_user['email'] ?>">
									<button type="submit"><i class="far fa-envelope "></i></button>
									</form>
								<!-- <span class="ml-1">?</span> -->
								<?php //var_dump($followers); ?>
							</div>
						</div>
						<hr>
					<?php endforeach; 
				endforeach; 
					//var_dump($tweet);
					endforeach;
			 	endforeach;?>
				<!-- fin de la div qui contient le tweet (div a boucler) -->
			</div>

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