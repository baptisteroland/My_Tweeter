<?php
include('../controller/bdd.php');
class profil extends Database
{
	public function profil_update()  
	{   
		$update = $this->update("user", "`username` = :username, `email` = :email", "id_user = :id_user");
		$update->bindValue(":id_user", $_SESSION['id_user']);
		$update->bindValue(":username", $_POST['username']);
		$update->bindValue(":email", $_POST['email']);
		$update->execute();
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['email'];
		echo "ok";
		header('Location: ../views/modif_profil.php');
	}  

	public function password_update()  
	{   
		extract($_POST);
		$db = new Check();
		$bool = $db->check_update();

		/* HACHAGE MDP */
		$hash = new tools();
		$password = $hash->hashPassword($new_password);
		/* HACHAGE MDP */

		if($bool == true)
		{
				$update = $this->update("user", "`password` = :password", "id_user = :id_user");
				$update->bindValue(":id_user", $_SESSION['id_user']);
				$update->bindValue(":password", $password);
				$update->execute();
				echo "ok";
		header('Location: ../views/modif_profil.php');
		}
	}


	public function desactivate_account()  
	{   
		//var_dump($_POST);
		extract($_POST);
		$db = new Check();
		$bool = $db->check_desactivate();

		/* HACHAGE MDP */
		$hash = new tools();
		$password = $hash->hashPassword($password);
		/* HACHAGE MDP */

		if($bool == true)
		{
				$update = $this->update("user", "`status` = '0'", "id_user = :id_user");
				$update->bindValue(":id_user", $_SESSION['id_user']);
				$update->execute();
				echo "ok";
		header('Location: ../modele/logout.php');
		}
	}  
}

if(isset($_POST['profil_update']))
{
	$profil = new profil();
	$profil = $profil->profil_update();
}

if(isset($_POST['password_update']))
{
	$profil = new profil();
	$profil = $profil->password_update();
}

if(isset($_POST['desactive']) )
{
	$profil = new profil();
	$profil = $profil->desactivate_account();
}
