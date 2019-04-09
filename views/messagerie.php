<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Messagerie</title>
	<meta charset="utf-8">

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
			<link rel="stylesheet" type="text/css" href="css/theme_silver/messagerie.css">
			<link rel="stylesheet" type="text/css" href="css/theme_silver/actualite.css">
			<?php
		}
		elseif($theme == "#FEEAFB")
			{ ?>
				<link rel="stylesheet" type="text/css" href="css/theme_pink/messagerie.css">
				<link rel="stylesheet" type="text/css" href="css/theme_pink/actualite.css">
			<?php } 
			else
				{ ?>
					<link rel="stylesheet" type="text/css" href="css/theme_default/messagerie.css">
					<link rel="stylesheet" type="text/css" href="css/theme_default/actualite.css"><?php
				} ?>
				<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
			</head>
			<body class="body--color">
				<?php 
				include('navbar.php');
				
	//var_dump($_SESSION);
				$messagerie = new messagerie();
				$get_msg_send = $messagerie->getSender($_SESSION['id_user']);
				$get_msg_receive = $messagerie->getReceiver($_SESSION['id_user']);
				//var_dump($get_msg_receive);?>

				<div class="float-left bg-light pt-2 ml-lg-5 col-lg-5 col-md-12 col-sm-12 col-xs-3 mt-lg-0 mt-md-5 mt-sm-5 select_sendEnvoi font-weight-bold">
					<div class="link--sendEnv pr-2" id="buttSend">
						<p class="pt-4 pb-3 pl-3">Messages envoyés<i class="fas fa-angle-right float-right"></i></p>
					</div>
					<hr>
					<div class="link--sendEnv pr-2" id="buttReceive">
						<p class="pt-3 pb-3 pl-3">Messages reçus<i class="fas fa-angle-right float-right"></i></p>
					</div>
				</div>
				<div class="container contain--all--messagerie col-lg-6 col-md-12 mb-5 pb-3">
					<div class="form-inline mb-3 mt-2">
						<h2 class="font-weight-bold m-2">Messages privés</h2>
						<div class="col-lg-6 col-md-3 col-sm-4 ml-4 text-right">
							<a class="button--newmsg  p-1 pr-2 pl-2" href="newmessage.php">Nouveau message</a>
						</div>
					</div>
					<div class="contain--all--msgpv p-5">
						<!-- Contiendra Les conversation !! Au clique, sa nous dirigera sur la conversation instantané -->
						<div class="container contain--message" id="msgsend">

							<?php foreach ($get_msg_send as $msg):
								extract($msg);
								$conversation = $messagerie->getMsgSend($_SESSION['id_user'], $id_receiver);
								foreach ($conversation as $receive):
									$infos_sender = $messagerie->getInfosUsers($receive['id_receiver']);
									foreach ($infos_sender as $receiver):
										$message = $messagerie->getLastMessage($_SESSION['id_user'], $id_receiver);
										foreach ($message as $last):
											?>
											<div class="float-right p-3 ">
												<p class="font-weight-bold ml-2 color--black block--string date--color"><?= $last['date_message']?> </p>
											</div>
											<div class="p-2 block--string d-inline">
												<div class="img--user ">
													<!-- IMAGE PROFIL -->
													<?php if ($avatar !== null) 
													{
														?> <img src="../controller/img/<?= $avatar ?>"  class="float-left" alt="profil" width="40" height="40"> <?php
													} 
													else
														{?>
															<img src="img/user.png"  class="float-left" alt="users picture">
														<?php }	?>
													</div>
													<form action="newmessage.php" method="get">
														<input type="hidden" name="id_user" value ="<?= $receiver['id_user'] ?>">
														<input type="hidden" name="destinataire" value ="<?= $receiver['email'] ?>">
														<p class="font-weight-bold color--black user--color ml-3 mb-0"><button type="submit"><?= "@".$receiver['username'] ?></button></p>
														<div class="container col-lg-10">
															<p class="ml-3 color--black"><?= $last['content_message'] ?></p>
														</div>
													</form>
												</div>
												<hr class="mb-0 mt-0">
												<?php 
											endforeach;
										endforeach;
									endforeach; 
								endforeach; 

								?>

							</div>
							<div class="container contain--message" id="msgreceive">

								<?php 

								foreach ($get_msg_receive as $msg):
								//var_dump($msg);
									extract($msg);
									$conversation = $messagerie->getMsgReceive($_SESSION['id_user'], $id_sender);
			//var_dump($conversation);
									foreach ($conversation as $send):
										$infos_sender = $messagerie->getInfosUsers($send['id_sender']);
										foreach ($infos_sender as $sender):
											$message = $messagerie->getLastMessage($id_sender, $_SESSION['id_user']);
	  				//var_dump($message);
											foreach ($message as $last):
												?>
												<div class="float-right p-3">
													<p class="font-weight-bold ml-2 color--black date--color"><?= $last['date_message']?> </p>
												</div>
												<div class="p-2 block--string d-inline">
													<div class="img--user ">
														<!-- IMAGE PROFIL -->
														<?php if ($sender['avatar'] !== null) 
														{
															?> <img src="../controller/img/<?= $sender['avatar'] ?>"  class="float-left" alt="profil" width="40" height="40"> <?php
														} 
														else
															{?>
																<img src="img/user.png"  class="float-left" alt="users picture">
															<?php }	?>
														</div>
														<form action="newmessage.php" method="get">
															<input type="hidden" name="id_user" value ="<?= $sender['id_user'] ?>">
															<input type="hidden" name="destinataire" value ="<?= $sender['email'] ?>">
															<p class="font-weight-bold color--black user--color ml-3 mb-0">
																<button type="submit"><?= "@".$sender['username'] ?></button></p>
																<div class="container col-lg-10">
																	<p class="ml-3 color--black"><?= $last['content_message'] ?></p>
																</div>
															</form>
														</div>
														<hr class="mb-0 mt-0">

														<?php 
													endforeach;
												endforeach;
											endforeach; 
										endforeach; 

										?>
									</div>
								</div>
							</div>
							<script src="jquery-3.3.1.min.js"></script>
							<script src="../javascript/SendEnvoyer.js"></script>
						</body>
						</html>
