

<?php
session_start();
class Database
{
	public $pdo;
	private $host;
	private $database;
	private $username;
	private $password;

	public function __construct($database = "common-database", $username = "root", $password = "")
	{
		$this->connection($database, $username, $password);
	}

	public function connection($database, $username, $password)
	{
		try
		{
			$this->pdo = new PDO('mysql:host=127.0.0.1;dbname='.$database.';charset=utf8', $username, $password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die("Connexion échouée : ". $e->getMessage());
		}

	}

	public function select($column, $table)
	{
		$query = "SELECT ".$column." FROM ".$table;
		//var_dump($query);
		$result = $this->pdo->prepare($query);
		$result->execute();
		return $result->fetchAll();	
	}


	public function insert($table, $column, $values)
	{
		$query = "INSERT INTO ".$table." (".$column.") VALUES (".$values.");";
		//var_dump($query);
		$insert = $this->pdo->prepare($query);
		return $insert;	
	}

	public function update($table, $values, $condition)
	{
		$query = "UPDATE ".$table." SET ".$values." WHERE ".$condition."";
		var_dump($query);
		$update = $this->pdo->prepare($query);
		return $update;	
	}

	public function delete($table, $condition)
	{
		$query = "DELETE ".$table." WHERE ".$condition."";
		//var_dump($query);
		$delete = $this->pdo->prepare($query);
		return $delete;	
	}
	
	public function getInfosUsers($id)
	{
		$infos_users = $this->select("*", "user WHERE id_user = '".$id."'");
		return $infos_users;
	}

}


/* VERIFICATION DE DONNEES */


class Check extends Database
{

	/* INSCRIPTION */
	public function check_subscrire()
	{
		$check_duplicates = $this->select("*", "user");
		if(!empty($check_duplicates))
		{
			foreach($check_duplicates as $result):
			endforeach;
			extract($result);
			if($username === $_POST['username'] || $email === $_POST['email'])
			{
				$_SESSION['error'] = "Pseudo ou email déjà inscrit.";
				include('../views/error.php');
				return false;
			}
		}
		$uppercase_pseudo = preg_match('@[A-Z]@', $_POST['username']);
		$lowercase_pseudo = preg_match('@[a-z]@', $_POST['username']);

		$number_lastname = preg_match('@[0-9]@', $_POST['lastname']);
		$alpha_lastname = preg_match("/^[A-Za-z]+(\s[A-Za-z]+)*$/", $_POST['lastname']);

		$number_firstname = preg_match('@[0-9]@', $_POST['firstname']);
		$alpha_firstname = preg_match("/^[A-Za-z]+(\s[A-Za-z]+)*$/", $_POST['firstname']);

		if($_POST['password'] !== $_POST['confirmPass']) 
		{
			$_SESSION['error'] = "Les mots de passes ne sont pas identiques.";
			include('../views/error.php');
			return false;
		}
		
		elseif($_POST['username'] == "" || $_POST['lastname'] == "" || $_POST['firstname'] == "" || (ctype_space($_POST['username'])) || (ctype_space($_POST['lastname'])) || (ctype_space($_POST['firstname'])))
		{
			$_SESSION['error'] = "Les champs ne peuvent pas être vide.";
			include('../views/error.php');
			return false;
		}
		elseif($number_lastname || $number_firstname || !$alpha_firstname || !$alpha_lastname)
		{
			$_SESSION['error'] = "Votre nom/prénom ne peut pas contenir de chiffres ou de caractères spéciaux.";
			include('../views/error.php');
			return false;
		}
		else
		{
			//echo "Inscription reussie !";
			return true;
		}

	}

	/* CONNEXION */

	public function check_login()
	{
		include('../controller/tools.php');
		//var_dump($_POST);
		$get_info_users = $this->select("*", "user WHERE email = '".$_POST['email']."'");

		/* HACHAGE MDP */
		$hash = new tools();
		$password_hashed = $hash->hashPassword($_POST['password']);
		/* HACHAGE MDP */

		if($get_info_users)
		{
			foreach($get_info_users as $result):
			endforeach;
			extract($result);
			if($status != "1")
			{
			$_SESSION['error'] = "Votre compte a été supprimé.";
			include('../views/error.php');
				return false;
			}
			elseif (empty($_POST['email']) && empty($_POST['password']) ) // si les champs sont vides
			{
			$_SESSION['error'] = "Vous devez remplir tous les champs.";
			include('../views/error.php');
				return false;
			}
			elseif ($password == $password_hashed) // Acces OK !
			{
				return true;
			}
			else 
			{
			$_SESSION['error'] = "Le mot de passe ou le pseudo entré n'est pas correcte.";
			include('../views/error.php');
				return false;
			}
		}
		$_SESSION['error'] = "Ce compte n'existe pas.";
		include('../views/error.php');
		?>

		<?php
		return false;

	}


		/* MODIFICATION DE COMPTE */

	public function check_update()
	{
		include('../controller/tools.php');
		$get_info_users = $this->select("*", "user WHERE id_user = '".$_SESSION['id_user']."'");

		/* HACHAGE MDP */
		$hash = new tools();
		$password_hashed = $hash->hashPassword($_POST['old_password']);
		/* HACHAGE MDP */;
		//var_dump($password_hashed);

		if($get_info_users)
		{
			foreach($get_info_users as $result):
			endforeach;
			extract($result);
		//var_dump($password);
			if (empty($_POST['new_password']) || empty($_POST['old_password']) ) // si les champs sont vides
			{
			$_SESSION['error'] = "Vous devez remplir tous les champs.";
			include('../views/error.php');
				return false;
			}
			elseif ($password == $password_hashed) // Acces OK !
			{
				if($_POST['new_password'] === $_POST['confirm_password'])
				{
				return true;
				}
				else
				{
			$_SESSION['error'] = "Les deux mots de passe ne sont pas identiques.";
			include('../views/error.php');
					return false;
				}
			}
			else 
			{
			$_SESSION['error'] = "Le mot de passe actuel n'est pas correcte.";
			include('../views/error.php');
				return false;
			}
		}
		return false;
	}

			/* DESACTIVATION DE COMPTE */
		
	public function check_desactivate()
	{
		include('../controller/tools.php');
		$get_info_users = $this->select("*", "user WHERE id_user = '".$_SESSION['id_user']."'");

		/* HACHAGE MDP */
		$hash = new tools();
		$password_hashed = $hash->hashPassword($_POST['password']);
		/* HACHAGE MDP */;
		//var_dump($password_hashed);

		if($get_info_users)
		{
			foreach($get_info_users as $result):
			endforeach;
			extract($result);
			//var_dump($password);
			if ($password == $password_hashed) // Acces OK !
			{
				return true;
			}
			else
			{
			$_SESSION['error'] = "Le mot de passe incorrect.";
			include('../views/error.php');
				return false;
			}
		}
		return false;
	}
}
?>