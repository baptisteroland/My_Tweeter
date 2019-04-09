<?php

class subscrire
{
	function subscrire_members()
	{
		//var_dump($_POST);
		extract($_POST);

		/* CONTROLLEUR */
		include('../controller/bdd.php');
		include('../controller/tools.php');
		$db = new Check();
		$bool = $db->check_subscrire();
		/* CONTROLLEUR */
		
		/* HACHAGE MDP */
		$hash = new tools();
		$password = $hash->hashPassword($password);
		/* HACHAGE MDP */

		if($bool == true)
		{
			$insert = $db->insert("`user`", "`id_user`, `username`, `email`, `firstname`, `lastname`, `password`, `avatar`, `theme`, `register_date`, `status`", "NULL, :username, :email, :firstname, :lastname, :password, NULL, '#1da1f2', CURRENT_TIMESTAMP, '1'");
			$insert->bindValue(':username', $username, PDO::PARAM_STR);
			$insert->bindValue(':email', $email, PDO::PARAM_STR);
			$insert->bindValue(':firstname', $firstname, PDO::PARAM_STR);
			$insert->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$insert->bindValue(':password', $password, PDO::PARAM_STR);
			$insert->execute();
			header("Location: ../views/connexion.php");
		}
		}
	}

$sub = new subscrire("common-database", "root", "");
$sub->subscrire_members();