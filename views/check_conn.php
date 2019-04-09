<?php 
if(empty($_SESSION))
{
	 header("refresh:3;url=index.php");
	 exit("Vous n'êtes pas connecté, vous allez être rediriger vers la page de connexion");
	//exit;
}

?>