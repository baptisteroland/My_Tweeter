<?php

include('bdd.php');

class messagerie extends Database
{

	public function new_message()
	{
		$c = strlen($_POST['msg']);
		if($c > 0)
		{
			$infos_destinataire = $this->select("id_user", "user WHERE email = '".$_POST['destinataire']."'");
			foreach ($infos_destinataire as $value):
				extract($value);
			endforeach;
			if($id_user !== null)
			{
				if($id_user !== $_SESSION['id_user'])
				{

					$content = $_POST['msg'];

					$hack = stripos($content, ';');
					$hack2 = stripos($content, '*');
					$hack3 = stripos($content, '<');
					$hack4 = stripos($content, '>');

					if ($hack !== false || $hack2 !== false || $hack3 !== false || $hack4 !== false)
					{
						$_SESSION['error'] = "Votre message comporte des caractères interdits !";
						include('../views/error.php');
						exit;
					}

					$new_message = $this->insert("message", "id_message, id_sender,	id_receiver, content_message, date_message, delete_message", "NULL, :id_sender, :id_receiver, :content_message, NOW(), '0'");
					$new_message->bindValue('id_sender', $_SESSION['id_user']);
					$new_message->bindValue('id_receiver', $id_user);
					$new_message->bindValue('content_message', $_POST['msg']);
					$new_message->execute();
					header('Location: ../views/newmessage.php?id_user='.$id_user.'&destinataire='.$_POST["destinataire"].'');
				}
				else
				{
					$_SESSION['error'] = "Vous ne pouvez pas envoyé un message à vous même !";
					include('../views/error.php');
				}
			}
			else
			{
				$_SESSION['error'] = "Cet utilisateur n'existe pas !";
				include('../views/error.php');
			}
		}
		else
		{
			$_SESSION['error'] = "Votre message ne peut être vide.";
			include('../views/error.php');
		}
	}

}

$user = new messagerie();
$result = $user->new_message();

?>