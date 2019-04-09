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
				<script src="jquery-3.3.1.min.js"></script>
			</head>
			<body class="mt-5 body--color pb-5 ">
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
	<div class="container text-center">
		<i class="far fa-comment icon--top--comment mt-5"></i>
	</div>
	<div class="container contain--actu p-0">
		<!-- Div qui contient tout ce qu'il y a au centre de la page -->
		<div class="col-lg-8 container col-md-6 contain--modif p-2">
			<img src="img/ajax-loader.gif" alt="chargement" id="loader" style="display: none;">
			<?php 
			include('timeline_notif.php'); ?>
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
        url:'timeline_notif.php', // rechargement de cette page
        success:function(data){
        	$("#loader").show().fadeOut(1000);
          $("div#new_tweet").html(data); //element dans lequel on va refresh la page
      }
  });
				}
    setInterval(refresh,10000); // interval en milliseconde


}); 
		}); 
	</script>
</body>
</html>