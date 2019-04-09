<?php

class logout
{
	public function disconnect()
	{
		session_start();
		$_SESSION = array();
		session_unset();
		session_destroy();
		header('Location: ../views/connexion.php');
	}
}
$logout = new logout();
$logout->disconnect();