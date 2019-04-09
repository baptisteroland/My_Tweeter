<?php


class Userr extends Database
{

	public function followMembers()
	{
		$modele = new UserModele();
		extract($_POST);
		$check_user_exist = $this->getInfosUsers($id_followed);
		//var_dump($check_user_exist);
		if(!empty($check_user_exist))
		{
			foreach ($check_user_exist as $key) {
			//var_dump($key);
			}
			if($key['id_user'] === $id_followed)
			{
				$check_duplicates = $this->select("*", "follow WHERE id_followed = '".$id_followed."' AND id_follower = '".$_SESSION['id_user']."'");
			}
			if(empty($check_duplicates))
			{
				foreach ($check_duplicates as $value) {
				}
				if($value['id_followed'] !== $id_followed)
				{
					$modele->follow($id_followed, $_SESSION['id_user']);
				}

			}
			else
			{
				foreach ($check_duplicates as $value) {
				}
				if($value['status_follow'] === '0')
				{
					$modele->updateStatusFollow($_SESSION['id_user'], $value['id_followed'], "1");
				}
				else
				{
					$modele->updateStatusFollow($_SESSION['id_user'], $value['id_followed'], "0");
				}
			}
			//var_dump($check_duplicates);

		}
		else
		{
			echo"ce utilisateur n'existe pas";
		}
	}

	public function addComment()
	{

		$add_com =  $this->insert("comment", "id_comment, id_user, id_tweet, content_comment, date_comment, delete_comment", "NULL, :id_user, :id_tweet, :content_comment, NOW(), '0'");
		$add_com->bindValue(":id_user", $_SESSION['id_user']);
		$add_com->bindValue(":id_tweet", $_POST['id_tweet']);
		$add_com->bindValue(":content_comment", $_POST['content']);
		$add_com->execute();
		echo "commentaire posté";
	}

	public function getComment($id_tweet)
	{

		$get_com =  $this->select("*", "comment WHERE id_tweet = '". $id_tweet . "' ");
		return $get_com;

	}
}

if(isset($_POST['follow']))
{
	$user = new Userr();
	$user->followMembers();
}

if(isset($_POST['comment']))
{
	$user = new User();
	$user->addComment();
}