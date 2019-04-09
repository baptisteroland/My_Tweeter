<?php

class login
{
	function connection()
	{

		/* CONTROLLEUR */
		extract($_POST);
		include('../controller/bdd.php');
		//session_start();
		$db = new Check();
		$bool = $db->check_login();
		/* CONTROLLEUR */
		

		if($bool == true)
		{
			$get_infos_users = $db->select("*", "user WHERE email = '".$email."'");
			foreach($get_infos_users as $result):
			endforeach;
			extract($result);
			$_SESSION['id_user'] = $id_user;
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['password'] = $password;
			echo "Connexion reussi";
			header("Location: ../views/actualite.php");
			var_dump($_SESSION);
		}
	}
}

$login = new login("common-database", "root", "");
$login->connection();