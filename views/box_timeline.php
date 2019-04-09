
<?php
			if(!isset($user))
			{

				include('../modele/tweet.php');
				extract($_SESSION);
				$user = new Modele();
			}
			$get_nbr_tweet = $user->countTweet($_SESSION['id_user']);
			foreach ($get_nbr_tweet as $nbr_tweet):
			endforeach;
			$get_following = $user->countFollowing($_SESSION['id_user']);
			foreach ($get_following as $following):
			endforeach;
			$get_followers = $user->countFollowers($_SESSION['id_user']);
			foreach ($get_followers as $followers):
			endforeach;
			?>

				<div class=" text-center form-inline mt-3 container col-11"  id="box_profil">
					<a href="profil_tweet.php">
						<div>
							<p class="mb-0">Tweets</p>
						</div>
						<div >
							<p class="number"><?= $nbr_tweet['COUNT(id_tweet)'] ?></p>
						</div>
					</a>
					<a href="profil_following.php" class="ml-3">
						<div>
							<p class="mb-0">Following</p>
						</div>
						<div>
							<p class="number"><?= $following['COUNT(id_followed)'] ?></p>
						</div>
					</a>
					<a href="profil_followers.php" class="ml-3">
						<div>
							<p class="mb-0">Followers</p>
						</div>
						<div >
							<p class="number"><?= $followers['COUNT(id_follower)'] ?></p>
						</div>
					</a>
				</div>
				<?php //var_dump($followers); ?>