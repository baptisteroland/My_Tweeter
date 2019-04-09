<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Actu</title>
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
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/profil_tweet.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css">
					<?php
				} ?>
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body class="mt-5 body--color pb-5">
				<?php 
				include('navbar.php');
				extract($_SESSION);
				$user = new Modele();
				$get_tweet = $user->getAllTweet($_SESSION['id_user']);
				$get_retweet = $user->getRetweet($_SESSION['id_user']);
				$info_users = $user->getInfosUsers($_SESSION['id_user']);
				$get_nbr_tweet = $user->countTweet($_SESSION['id_user']);
				foreach ($get_nbr_tweet as $nbr_tweet):
				endforeach;
				$get_following = $user->countFollowing($_SESSION['id_user']);
				foreach ($get_following as $following):
				endforeach;
				$get_followers = $user->countFollowers($_SESSION['id_user']);
				foreach ($get_followers as $followers):
				endforeach;

	//var_dump($_SESSION);?>
<?php include('box_timeline_responsive.php'); ?>

	<div class="container contain--actu p-0">
		<!-- div qui contient tout ce qu'il y a dans la colonne de gauche de la page -->
		<div class="col-lg-3 d-lg-block d-md-block d-none p-0 div--profile1 float-lg-left">
			<div class="contain--profile">
				<div class="p-2 div--profile2 text-center">
					<?php if ($avatar !== null) 
					{
						?> <img src="../controller/img/<?= $avatar ?>" width="130" height="130" alt="profil"> <?php
					} 
					else
						{?>
							<img src="img/user.png" width="130" height="130" alt="users picture">
						<?php }	?>
					</div>
					<div class="text-center bg-light p-5 link--profil">
						<p class="font-weight-bold mb-0 p-0 h3 link--username"><a href="profil_tweet.php"><?= $username ?></a></p>
						<p class="font-weight-bold mb-0"><a href="profil_tweet.php">@<?= $username ?></a></p>
					</div>
				</div>
				<div class="contain--link--count--div mt-3">

					<?php include('box_timeline.php'); ?>

				</div>
				<div class="p-3 mt-3 contain--link--left">
					<p class="mt-3 mb-0 font-weight-bold h4"><?= $username ?></p>
					<p class="h4 mb-4">@<?= $username ?></p>
					<p class="resume--text">West coast, plus que deter on va tout niquer.</p>
					<a href="#"><p class=" blue--link">Paris, France</p></a>
					<p class="m-0 resume--text">Inscrit en février 2015</p>
					<p class="m-0 resume--text">Né le 28 septembre 1996</p>
					<a href="#"><p class="mt-3 blue--link mb-0">Dernières photos</p></a>
				</div>
			</div>

			<!-- Div qui contient tout ce qu'il y a au centre de la page -->
			<div class="col-lg-6 col-md-8 ml-lg-3 ml-md-3 ml-sm-0 contain--modif p-2">
				<nav class="bg-light">
					<form class="form-inline pic--center--page" method="post" action="../controller/functions.php" id="form_tweet" enctype="multipart/form-data" >
						<!-- IMAGE PROFIL -->
						<?php if ($avatar !== null) 
						{
							?> <img src="../controller/img/<?= $avatar ?>"  class="mr-2 mb-1" width="40" height="40" alt="profil"> <?php
						} 
						else
							{?>
								<img src="img/user.png"  class="mr-2 mb-1" width="40" height="40" alt="users picture">
							<?php }	?>
							<input class="form-control mr-sm-2 col-lg-9 col-md-9 col-sm-9 input-search" type="text" name="tweet" id="tweet" placeholder="Tweet..." aria-label="Search">
							<button class=" my-2 my-sm-0 p-sm-1 butt--tweet font-weight-bold" type="submit">Tweet</button>
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<label for="testmodif" class="mt-3 choose--img"></label>
							<input type="file" name="monfichier" class="modif--visu--input mt-2 ml-5" id="testmodif" />
						</form>
					</nav>
					<img src="img/ajax-loader.gif" alt="chargement" id="loader" style="display: none;">
					<hr class="text-dark">

					<?php include('timeline.php'); ?>
				</div>
			</div>
			</div>
			<script>
				$(document).ready(function(){  

					$(function() {
						$("#form_search").submit(function()
						{
							tag = $(this).find("input[name=tag]").val();
							$.get("../controller/functions.php",$(this).serialize(),function(texte){
            //(this).serialize() récupère l'ensemble des donnés traité du formulaire EN COURS

            if(tag == "")
            {
            	$("div#result").empty().hide().append("erreur").fadeIn(1000);
            	stop();
            }
            else
            {
            	$("div#result").empty().hide().append(texte).fadeIn(1000);
            }


        });
							return false;
						});

						var refresh = function(){
							$.ajax({
								method:'post',
								cache: false,
        url:'timeline.php', // rechargement de cette page
        success:function(data){
        	$("#loader").show().fadeOut(1000);
          $("div#new_tweet").html(data); //element dans lequel on va refresh la page
      }
  });
						}
    setInterval(refresh,60000); // interval en milliseconde

    var refresh_box_profil = function(){
    	$.ajax({
    		method:'post',
    		cache: false,
        url:'box_timeline.php', // rechargement de cette page
        success:function(data){
        	//alert('ok');
          $("div#box_profil").replaceWith(data); //element dans lequel on va refresh la page
      }
  });
    }
    setInterval(refresh_box_profil,10000); // interval en milliseconde


}); 
				}); 
			</script>
		</body>
		</html>