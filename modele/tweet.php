<?php
include('../controller/bdd.php');

class Modele extends Database
{

	public function getInfosUsersbyName($username)
	{
		$infos_users = $this->select("*", "user WHERE username = '".$username."'");
		return $infos_users;
	}

	/* Transforme string contenant # en lien */
	public function getHashtag($string)  
	{  
		$expression = "/#+([a-zA-Z0-9_]+)/";
		$string = preg_replace($expression, '<a href="../views/recherche.php?tag=%23$1&search_tag">$0</a>', $string); 
		return $string;  
	}  

	/* Transforme string contenant @ en lien */
	public function targetProfil($string)  
	{  
		$expression = "/@+([a-zA-Z0-9_]+)/";
		$string = preg_replace($expression, '<a href="../views/profil_user.php?pseudo=$1">$0</a>', $string); 
		return $string;  
	}

	/* Transforme string contenant # ou @ en lien */
	public function transformString($string)
	{
		$string = $this->getHashtag($string);
		$string = $this->targetProfil($string);
		return $string;
	}
	/* 


	RECHERCHE / TWEET / HASHTAG 


	*/

	/* Obtenir les infos du dernier tweet d'un utilisateur */
	public function getlastIdTweet($id_user)
	{
		$last_id_tweet = $this->select("*", "tweet WHERE id_user = '".$id_user."' ORDER BY date_tweet DESC LIMIT 1");
		return $last_id_tweet;
	}

	/* Recherche tag  */
	public function searchHashtaglike($name_hashtag)
	{
		$search = $this->select("*", "hashtag WHERE name_hashtag LIKE '%" . $name_hashtag . "%'");
		return $search;
	}

	/* Recherche tag existant  */
	public function searchHashtag_exists($name_hashtag)
	{
		$search = $this->select("*", "hashtag WHERE name_hashtag = '".$name_hashtag."'");
		return $search;
	}

	/* Recherche profil  */
	public function search($pseudo)
	{
		$search = $this->select("*", "user WHERE username LIKE '%".$pseudo."%'");
		return $search;
	}

	/* Obtenir les hashtag d'un tweet  */
	public function getHashtagToTweet($id_hashtag, $id_tag)
	{
		$get_hash_to_tweet = $this->select("*", "hashtag, tweet_to_tag WHERE id_hashtag = '" . $id_hashtag ."' AND id_tag = '" . $id_tag ."' AND hashtag.id_hashtag = tweet_to_tag.id_tag");
		return $get_hash_to_tweet;
	}

	/* Obtenir les id d'un hashtag à partir d'un id tweet */
	public function getTweetToTag($id_tweet)
	{
		$getHashtag = $this->select("*", "tweet_to_tag WHERE id_tweet = '" . $id_tweet ."'");
		return $getHashtag;
	}

	/* Obtenir les id d'un tweet à partir d'un id hashtag */
	public function getIdTweetByTag($id_tag)
	{
		$getIdTweet = $this->select("*", "tweet_to_tag WHERE id_tag = '" . $id_tag ."'");
		return $getIdTweet;
	}

	/* Retourne les id hashtag d'un tweet sans doublons */
	public function checkTagDoublons($id_tag)
	{
		$check = $this->select("DISTINCT id_tag", "tweet_to_tag WHERE id_tag = '" . $id_tag ."'");
		return $check;
	}

	/* Obtenir les infos d'un hashtag à partir d'un id hashtag */
	public function getHashtagById($id_hashtag)
	{
		$getHashtag = $this->select("*", "hashtag WHERE id_hashtag = '" . $id_hashtag ."'");
		return $getHashtag;
	}

	/* Obtenir les infos d'un tweet */
	public function getInfosTweet($id_tweet)
	{
		
		$infos_tweet = $this->select("*", "tweet WHERE id_tweet = '" . $id_tweet ."'");
		return $infos_tweet;
	}

	/* Ajout de hashtag */
	public function insertNewHashtag($hashtag)
	{
		$insert = $this->insert("hashtag", "id_hashtag, name_hashtag", "NULL, :name_hashtag");
		$insert->bindValue(':name_hashtag', $hashtag, PDO::PARAM_STR);
		$insert->execute();
	}

	/* Ajout de hashtag lié au tweet  */
	public function inserttweetToTag($id_tweet, $hashtag)
	{
		$insert = $this->insert("tweet_to_tag", "id_tweet, id_tag, status_ttt", ":id_tweet, :id_hashtag, '0'");
		$insert->bindValue(':id_tweet', $id_tweet, PDO::PARAM_INT);
		$insert->bindValue(':id_hashtag', $hashtag, PDO::PARAM_INT);
		$insert->execute();
	}

	/* Envoi du tweet  */
	public function insertTweet($id_user, $content)
	{
		$hack = stripos($content, ';');
		$hack2 = stripos($content, '*');
		$hack3 = stripos($content, '<');
		$hack4 = stripos($content, '>');
 
			if ($hack !== false || $hack2 !== false || $hack3 !== false || $hack4 !== false)
			{
					$_SESSION['error'] = "Votre tweet comporte des caractères interdits !";
					include('../views/error.php');
					exit;
			}

		$content = htmlspecialchars($content, ENT_QUOTES);
		$insert = $this->insert("tweet", "`id_tweet`, `id_user`, `content_tweet`, `date_tweet`, `delete_tweet`", "NULL, :id_user, :content, CURRENT_TIMESTAMP, '0'");
		$insert->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$insert->bindValue(':content', $content, PDO::PARAM_STR);
		$insert->execute();
		//echo "Tweet posté";
		header('Location: ../views/actualite.php');

	}


		/* 

		RETWEET

		*/


		/* Obtenir les infos d'un retweet(status) */
		public function getRetweet_status($id_tweet, $id_user)
		{
			$check_duplicates = $this->select("*", "retweet WHERE id_tweet = '".$id_tweet."' AND id_user = '".$id_user."'");
			return $check_duplicates;

		}
		/* Mise à jour du retweet */
		public function updateRetweet_status($id_user, $delete_retweet, $id_tweet, $status)
		{

			$follow =  $this->update("retweet", "delete_retweet = :delete_retweet, date_retweet = NOW()", ":id_tweet AND id_user = :id_user AND delete_retweet = :status");
			$follow->bindValue(":delete_retweet", $delete_retweet);
			$follow->bindValue(":id_user", $id_user);
			$follow->bindValue(":id_tweet", $id_tweet);
			$follow->bindValue(":status", $status);
			$follow->execute();
			echo "retweet miseajour";
				header('Location: ' . $_SERVER['HTTP_REFERER'] );
		}

		/* Envoi du retweet  */
		public function sendRetweet($id_user, $id_tweet)
		{
			$insert = $this->insert("retweet", "`id_retweet`, `id_user`, `id_tweet`, `date_retweet`, `delete_retweet`", "NULL, :id_user, :id_tweet, CURRENT_TIMESTAMP, '0'");
			$insert->bindValue(':id_user', $id_user, PDO::PARAM_INT);
			$insert->bindValue(':id_tweet', $id_tweet, PDO::PARAM_INT);
			$insert->execute();
			echo "retweet posté";
				header('Location: ' . $_SERVER['HTTP_REFERER'] );

		}

	/* 

	LIKES

	*/

	/* Obtenir les infos d'un like(status) */
	public function getLike_status($id_user, $id_tweet)
	{

		$check_duplicates = $this->select("*", "likes WHERE id_user = '".$id_user."' AND id_tweet = '".$id_tweet."'");
		return $check_duplicates;
	}

	/* Ajout du like  */
	public function likeTweet($id_user, $id_tweet)
	{

		$insert = $this->insert("likes", "`id_like`, `id_user`, `id_tweet`, `status_like`", "NULL, :id_user, :id_tweet, '1'");
		$insert->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$insert->bindValue(':id_tweet', $id_tweet, PDO::PARAM_INT);
		$insert->execute();
		echo "like";
				header('Location: ' . $_SERVER['HTTP_REFERER'] );
	}

	/* Mise à jour du like */
	public function updateLike_status($id_tweet, $status_like)
	{

		$follow =  $this->update("likes", "status_like = :status_like", "id_user = :id_user");
		$follow->bindValue(":status_like", $status_like);
		$follow->bindValue(":id_user", $_SESSION['id_user']);
		$follow->execute();
		echo "unlike";
				header('Location: ' . $_SERVER['HTTP_REFERER'] );
	}


	/* Obtenir tous les tweet d'un utilisateur  */
	public function getAllTweet($id)
	{
		$all_tweet = $this->select("*", "tweet WHERE id_user = '".$id."' ORDER BY date_tweet DESC");
		return $all_tweet;
	}

	/* Obtenir tous les tweet d'un utilisateur et de ces followings */
	public function displayAllTweet($id_user, $followers)
	{
		//var_dump(count($followers));
		//var_dump($followers[0]);
		$nbr_followers = count($followers);
		$id_followers = "";
		foreach ($followers as $id):
			$explode = implode("  OR id_user = ", $id);
			$explode = substr($explode, 2, strlen($explode));
			$id_followers .= $explode;
		//var_dump($explode);
		endforeach;
		//echo $id_followers;
		//echo $followers[0];
		$all_tweet = $this->select("*", "tweet WHERE id_user = '".$id_user."' ".$id_followers." ORDER BY date_tweet DESC");
		foreach ($all_tweet as $media) {
			$this->displayImg($media['id_user']);
		}	
		return $all_tweet;
	}

	public function displayImg($id_tweet)
	{
		$all_media = $this->select("*", "media WHERE id_tweet = '".$id_tweet."'");
		return $all_media;

	}

	/* Obtenir tous les infos retweet d'un retweet (dont celui qui la retweet)  */
	public function getRetweet($id)
	{
		$retweet = $this->select("*", "`retweet` WHERE id_tweet = ".$id." AND delete_retweet ='0' ORDER BY date_retweet DESC");
		return $retweet;
	}

	/* Obtenir tous les following d'un user */
	public function getFollowing($id)
	{
		$following = $this->select("id_followed", "follow WHERE id_follower = '".$id."' AND status_follow = '1'");/*
		foreach ($following as $value):
			$infos_following = $this->bdd->select("*", "user WHERE id_user = '".$value['id_followed']."'");
		endforeach;*/

		return $following;
	}

	/* Obtenir tous les followers d'un user */
	public function getFollowers($id)
	{
		$following = $this->select("id_follower", "follow WHERE id_followed = '".$id."'");/*
		foreach ($following as $value):
			$infos_following = $this->bdd->select("*", "user WHERE id_user = '".$value['id_followed']."'");
		endforeach;*/

		return $following;
	}


	/* COMPTAGE */

	/* Compte les com d'un tweet */
	public function countCom($id_tweet)
	{
		$count_like = $this->select("COUNT(id_comment)", "comment WHERE id_tweet = ".$id_tweet." AND delete_comment ='0'");
		return $count_like;
	}	

	/* Compte les likes d'un tweet */
	public function countLike($id_tweet)
	{
		$count_like = $this->select("COUNT(id_like)", "likes WHERE id_tweet = ".$id_tweet." AND status_like ='1'");
		return $count_like;
	}	

	/* Compte les tweet d'un user */
	public function countTweet($id)
	{
		$nb_tweet = $this->select("COUNT(id_tweet)", "tweet WHERE id_user = '".$id."'");
		return $nb_tweet;
	}	

	/* Compte les retweet d'un user */
	public function countRetweet($id)
	{
		$nb_retweet = $this->select("COUNT(id_retweet)", "retweet WHERE id_tweet = '".$id."' AND delete_retweet ='0'");
		return $nb_retweet;
	}	


	/* Compte les followers d'un user */
	public function countFollowers($id)
	{
		$followers = $this->select("COUNT(id_follower)", "follow WHERE id_followed = '".$id."' AND status_follow ='1'");
		return $followers;
	}

	/* Compte les following d'un user */
	public function countFollowing($id)
	{
		$following = $this->select("COUNT(id_followed)", "follow WHERE id_follower = '".$id."' AND status_follow ='1'");
		return $following;
	}


public function tri()
{
	$string =""; 	
	$user = new Modele();
	/*Récupere tous mes tweets*/
	$tweet_followers = $user->getFollowing($_SESSION['id_user']);
	$all_tweet = $user->displayAllTweet($_SESSION['id_user'], $tweet_followers);
	//var_dump($all_tweet);
	/*Initilisation array pour stocker date tweets*/
	$array = array(); 	
	/*Initilisation array2 pour stocker date retweet*/
	$array2 = array(); 	
	$i=0;

	foreach ($all_tweet as $key):
		/*recupére les retweet en fonction ds tweet*/
		$retweet = $user->getRetweet($key['id_tweet']);
		//var_dump($retweet);
		/*on stocke les tweet dans array avec date tweet et lid du celui qui la posté*/
		$array[] = array("id_tweet"=>$key["id_tweet"], "date"=>$key["date_tweet"], "id_user_tweet"=>$key["id_user"]);

		foreach ($retweet as $value):
			/*on stocke les retweet dans array2 avec date retweet et celui qui la retweet*/
			$array2[] = array("id_retweet"=>$key["id_tweet"], "date"=>$value["date_retweet"], "id_user_retweet"=>$value["id_user"]);
		endforeach;
	endforeach;


	//var_dump($array);
	//var_dump($array2);
	/*on fussione les array et array2*/
	$n = array_merge($array, $array2);

	/*on trie par date*/
	function sortByDate($a, $b)
	{
		$da = $timestamp = strtotime($a['date']);
		$db = $timestamp = strtotime($b['date']);
		return $da - $db;
	}
	usort($n, 'sortByDate');
	/*on retourne le tableau pour avoir un ordre desc*/
	$tri = array_reverse($n);
	//var_dump($tri);
	return $tri;
}

}

class Upload extends Modele
{
	public function image_tweet($id_tweet, $name_file, $dir_file)
	{
		$dir_file = str_replace('\\', "/", $dir_file);
		$image = $this->insert("media", "id_media, id_tweet, name_media, file_media", "NULL, '".$id_tweet."', '".$name_file."', '".$dir_file."'");
		$image->execute();
		echo"ok";
		header('Location: ../views/actualite.php');
	}

	public function image_profil($name_file, $id_user)
	{
		$image = $this->update("user", "avatar = '".$name_file."'", "id_user = ".$id_user."");
		$image->execute();
		echo"ok";
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header('Location: ../views/profil_tweet.php');
		//header('Location: ../views/profil_tweet.php');
	}
}

class Search extends Modele
{


	public function searchProfil($tag)
	{
		//var_dump($_GET);

		$string = $tag;
		$string = substr($string,1,strlen($string));
		$search = $this->search($string);
		return $search;

	}

	public function searchHashtag($tag)
	{
		$tools = new tools();
		foreach ($tag as $hashtag):
		endforeach;
		$string = implode("#",$hashtag); 
		$string = str_replace("#", " ", $string);
		$nb_hashtag = count($hashtag); // Total de hashtag dans le tweet
		//var_dump($nb_hashtag);

		for($i=0; $i<$nb_hashtag; $i++)
		{
			$search = $this->searchHashtaglike($hashtag[$i]);
			//var_dump($search);
		}


return $search;
}

}

class messagerie extends Database
{
	/* Récupere toutes id personnes à qui $user à envoyé des messsage sans doublons */
	public function getSender($id_user)
	{
		$sender = $this->select("DISTINCT id_receiver", "user, message WHERE id_user = '".$id_user."' AND id_sender = '".$id_user."'");
		return $sender;
	}


	/* Récupere toutes id personnes qui ont envoyé des messsage à $user sans doublons */
	public function getReceiver($id_user)
	{
		$receiver = $this->select("DISTINCT id_sender", "user, message WHERE id_user = '".$id_user."' AND id_receiver = '".$id_user."'");
		return $receiver;
	}
	/* Obtenir tous les messages envoyé d'un expéditeur($user) et un destinataire (+infos) */
	public function getMsgSend($id_a, $id_b)
	{
		$msg_send = $this->select("*", "user, message WHERE id_user = '".$id_a."' AND id_receiver = '".$id_b."' ORDER BY date_message DESC LIMIT 1");
		return $msg_send;
	}

	/* Obtenir tous les messages reçu destinateur($user) et un expéditeur (+infos) */

	public function getMsgReceive($id_a, $id_b)
	{
		$msg_receive = $this->select("*", "user, message WHERE id_user = '".$id_a."' AND id_sender = '".$id_b."' ORDER BY date_message DESC LIMIT 1");
		return $msg_receive;
	}

	/* Obtenir conversations entre deux personnes */
	public function getConversations($id_sender, $id_receiver)
	{
		$get_conversations =$this->select("*", "message WHERE delete_message = '0' AND id_sender = '".$id_sender."' AND id_receiver = '".$id_receiver."' OR id_sender = '".$id_receiver."' AND id_receiver = '".$id_sender."' AND delete_message = '0' ORDER BY date_message ASC");
		return $get_conversations;
	}

		/* Obtenir conversations entre deux personnes */
	public function getLastMessage($id_sender, $id_receiver)
	{
		$last_msg =$this->select("*", "message WHERE delete_message = '0' AND id_sender = '".$id_sender."' AND id_receiver = '".$id_receiver."' ORDER BY date_message DESC LIMIT 1");
		return $last_msg;
	}
}

class User extends Modele
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
			//echo"ce utilisateur n'existe pas";
		}
	}

	public function addComment()
	{
		$content = $_POST['content'];

		$hack = stripos($content, ';');
		$hack2 = stripos($content, '*');
		$hack3 = stripos($content, '<');
		$hack4 = stripos($content, '>');
 
			if ($hack !== false || $hack2 !== false || $hack3 !== false || $hack4 !== false)
			{
					$_SESSION['error'] = "Votre commentaire comporte des caractères interdits !";
					include('../views/error.php');
					exit;
			}

		$add_com =  $this->insert("comment", "id_comment, id_user, id_tweet, content_comment, date_comment, delete_comment", "NULL, :id_user, :id_tweet, :content_comment, NOW(), '0'");
		$add_com->bindValue(":id_user", $_SESSION['id_user']);
		$add_com->bindValue(":id_tweet", $_POST['id_tweet']);
		$add_com->bindValue(":content_comment", $_POST['content'], PDO::PARAM_STR);
		$add_com->execute();
		echo "commentaire posté";
		header('Location: ' . $_SERVER['HTTP_REFERER'] );
	}

	public function getComment($id_tweet)
	{

		$get_com =  $this->select("*", "comment WHERE id_tweet = '". $id_tweet . "' ");
		return $get_com;

	}
}

class UserModele extends Database
{
	public function follow($id_followed, $id_follower)
	{
		$follow =  $this->insert("follow", "id_followed, id_follower, status_follow", ":id_followed, :id_follower, '1'");
		$follow->bindValue(":id_followed", $id_followed);
		$follow->bindValue(":id_follower", $id_follower);
		$follow->execute();
		header("location:".  $_SERVER['HTTP_REFERER']); 
	}

	public function updateStatusFollow($id_follower, $id_followed, $status_follow)
	{
		$update =  $this->update("follow", "status_follow = :status_follow", "id_follower = :id_follower AND id_followed = :id_followed");
		$update->bindValue(":id_follower", $id_follower);
		$update->bindValue(":id_followed", $id_followed);
		$update->bindValue(":status_follow", $status_follow);
		$update->execute();
header("location:".  $_SERVER['HTTP_REFERER']); 
	}
}
