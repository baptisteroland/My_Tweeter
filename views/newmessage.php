<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Messagerie</title>
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

		$content = $_GET['id_user'];
		$content2 = $_GET['destinataire'];

		$hack = stripos($content, ';');
		$hack2 = stripos($content, '*');
		$hack3 = stripos($content, '<');
		$hack4 = stripos($content, '>');


		$hack5 = stripos($content2, ';');
		$hack6 = stripos($content2, '*');
		$hack7 = stripos($content2, '<');
		$hack8 = stripos($content2, '>');
 
			if ($hack !== false || $hack2 !== false || $hack3 !== false || $hack4 !== false || $hack5 !== false || $hack6 !== false || $hack7 !== false || $hack8 !== false)
			{
					$_SESSION['error'] = "Impossible de faire ca !";
					include('../views/error.php');
					exit;
			}

	 if(!isset($_GET['destinataire']))
	 {
	 	$email_user_b = "";
	 }
	 else {
	 	$email_user_b= $_GET['destinataire'];
	 } 
	 if(!isset($_GET['id_user']))
	 {
	 	$id_user_b = "";
	 }
	 else {
	 	$id_user_b= $_GET['id_user'];
	 } 
	 $user = new messagerie();
	 $conversation = $user->getConversations($_SESSION['id_user'], $id_user_b);
	 $info_user = new Modele();

	 if(!empty($result))
	 {
	 	$username = $key['username'];
	 }
	 else
	 {
	 	$username = "Nouveau message";

	 }
	//var_dump($infos);

	 if ($theme == "#C7C3B4")
	 	{ ?>
	 		<link rel="stylesheet" type="text/css" href="css/theme_silver/newmessage.css">
	 		<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
	 		<link rel="stylesheet" type="text/css" href="css/theme_silver/profil_tweet.css">
	 		<link rel="stylesheet" type="text/css" href="css/theme_silver/modif_profil.css">
	 		<?php
	 	}
	 	elseif($theme == "#FEEAFB")
	 		{ ?>
	 			<link rel="stylesheet" type="text/css" href="css/theme_pink/newmessage.css">
	 			<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
	 			<link rel="stylesheet" type="text/css" href="css/theme_pink/profil_tweet.css">
	 			<link rel="stylesheet" type="text/css" href="css/theme_pink/modif_profil.css">

	 		<?php } 
	 		else
	 			{ ?>
	 				<link rel="stylesheet" type="text/css" href="css/theme_default/newmessage.css">
	 				<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css">
	 				<link rel="stylesheet" type="text/css" href="css/theme_default/profil_tweet.css">
	 				<link rel="stylesheet" type="text/css" href="css/theme_default/modif_profil.css">
	 				<?php
	 			} ?>
	 			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
	 		</head>
	 		<body class="body--color">
	 <?php include('navbar.php'); 	 
	 $result = $info_user->getInfosUsers($id_user_b); 
	 foreach ($result as $key):
	 endforeach;
	 if(!empty($result))
	 	{
	 		$pseudo = $key['username'];
	 	}
	 	else
	 	{
	 		$pseudo = "";
	 	}

	 	?>
	 			
	 						<form action="../controller/message.php" method="post" accept-charset="utf-8" id="form_search">

	 			<div class="container contain--all--messagerie col-md-7 mb-5 pb-3">
	 				<div class="row mt-2 container">
	 					<div>
	 						<p class="h1 font-weight-bold color--user p-2"><?= $user->transformString("@".$pseudo) ?></p>
	 					</div>
	 					<div class="col-lg-8 mt-2 ml-5">
	 							<input type="email" name="destinataire" placeholder="Email Destinataire" class="form-control col-md-6 float-right" value="<?= $email_user_b ?>">
	 						</div>
	 					</div>
	 					<!-- div qui contient tout les messages !! -->
	 					<div class="contain--all--msgpv mb-2" id="container-conversation">

	 						<!-- div d'un seul message (div a boucler) -->

	 						<?php 
					foreach ($conversation as $convers):
						$info_user = new Modele();
						$get = $info_user->getInfosUsers($convers['id_sender']); 
						foreach ($get as $value):
							$pseudo = $value['username'];?>

							<div class="block-message">
								<p class="mb-0 ml-3 mt-4 font-weight-bold h6 "><?= $pseudo ?> </p>
								<div class="p-2 col-lg-4 ml-5 mt-2 block--msg block--string">
									<p class="text-light mb-0"><?= $convers['content_message'] ?></p>
								</div>
							</div>


						<?php endforeach; ?>
					<?php endforeach;?>
				</div>
				<div class="container row ml-3 mt-3">
					<input type="text" name="msg" placeholder="Message..." class="form-control col-sm-9">
					<button class="btn color--dark bg--butt ml-5 col-lg-2" type="submit">Send<i class="fas fa-paper-plane ml-2 plane--send"></i></button>
				</div>
			</div>
			
				</form>

		<script>      

			$(document).ready(function(){  
				var scroll = document.getElementById('container-conversation');
				scroll.scrollTop = scroll.scrollHeight;
				scroll.animate({scrollTop: scroll.scrollHeight}, 1000000);
			}); 
			</script>
		</body>
		</html>
