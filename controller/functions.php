<?php
//include('user.php');
include('tools.php');
include('../modele/tweet.php');
//var_dump($_POST);

class tweet extends Modele
{

	public function insertHashtag($array)
	{
		foreach ($array as $hashtag):
		endforeach;
		$string = implode("#",$hashtag);
		$string = str_replace("#", " ", $string);
		$nb_hashtag = count($hashtag); // Total de hashtag dans le tweet
		$hashtag_expl = explode(" ", $string);

		if($nb_hashtag > 0)
		{
			/* On récupere l'id du dernier tweet */
			$info_tweet = $this->getlastIdTweet($_SESSION['id_user']);
			foreach ($info_tweet as $tweet):
			extract($tweet);
			endforeach;

			/* Tant qu'il y a des hashtags on insére */
			for($i=0; $i<$nb_hashtag; $i++)
			{

				/* Vérification des hashtags existants */
				$doublons = $this->searchHashtag_exists($hashtag_expl[$i]);
				foreach($doublons as $check):
				endforeach;
				if($check['name_hashtag'] !== $hashtag_expl[$i])
				{
					$this->insertNewHashtag($hashtag_expl[$i]);

				}
				/* On récupere l'id de chaque hashtag pour le lier à l'id du tweet */
				$hashtag = $this->searchHashtag_exists($hashtag_expl[$i]);
				foreach ($hashtag as $tag) :
					$this->inserttweetToTag($id_tweet, $tag['id_hashtag']);
				endforeach;


			}
		}
	}

	public function sendTweet()
	{
		$c = strlen($_POST['tweet']);
		if($_POST['tweet'] == "" || ctype_space($_POST['tweet']) AND ($_FILES['monfichier']['name'] == ""))
		{
			$_SESSION['error'] = "Votre tweet ne peut pas être vide.";
			include('../views/error.php');
		}
		elseif($c>140)
		{
			$_SESSION['error'] = "Votre tweet doit comporter moins de 140 caractères.";
			include('../views/error.php');
		}
		else
		{
			$this->insertTweet($_SESSION['id_user'], $_POST['tweet']);
		}
	}

	public function reTweet()
	{
		$check_duplicates = $this->getRetweet_status($_POST['id_tweet'], $_SESSION['id_user']);
		if(!empty($check_duplicates))
		{
			foreach ($check_duplicates as $value) {
			}
			if($value['id_tweet'] !== $_POST['id_tweet'])
			{
				$this->sendRetweet($_SESSION['id_user'], $_POST['id_tweet']);
			}
			else
			{
				if($value['delete_retweet'] === '0')
				{
					$this->updateRetweet_status($_SESSION['id_user'], "1", $_POST['id_tweet'], "0");
				}
				else
				{
					$this->updateRetweet_status($_SESSION['id_user'], "0", $_POST['id_tweet'], "1");
				}

			}
		}
		else
		{
			$this->sendRetweet($_SESSION['id_user'], $_POST['id_tweet']);
		}
	}

	public function uploadImg()
	{	
		$upload = new Upload();
		$img_name = $_FILES["monfichier"]["name"];
		$infos = $this->getInfosUsers($_SESSION["id_user"]);
		foreach($infos as $user):
		endforeach;
		$modele = $this->getlastIdTweet($_SESSION["id_user"]);
		foreach($modele as $details):
		endforeach;
		$infos_img = pathinfo($_FILES["monfichier"]["name"]);
		extract($infos_img);
		$id_tweet = ($details['id_tweet']) + 1;
		$current_dir = dirname(__FILE__);
		mkdir($current_dir."\img");
		$dir = $current_dir."\img/";
		//$dir = dirname(__FILE__)."/";
		//var_dump($dir);
		//exit;
		$image_name   = $id_tweet."_".$user['id_user']."_".date('Y_m_d').".".$extension."";
		if($extension === "jpg" || $extension  === "png" || $extension === "jpeg")
		{
			if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) 
			{
				if (rename($_FILES["monfichier"]["tmp_name"], $dir.$image_name)) 
				{
					$upload->image_tweet($id_tweet, $image_name, $dir.$image_name);
				} 
				else 
				{
					$_SESSION['error'] = "Erreur vérifiez l'existence du répertoire ".$dir."";
					include('../views/error.php');
				}    
			}
			else 
			{
				$_SESSION['error'] = "Le fichier n'a pas été uploadé (trop gros ?)";
				include('../views/error.php');
			}
		}
		else
		{

			$_SESSION['error'] = "Ceci n'est pas une image";
			include('../views/error.php');
		}
	}

	public function uploadImgProfil()
	{
		$upload = new Upload();
		$img_name = $_FILES["image_profil"]["name"];
		$infos = $this->getInfosUsers($_SESSION["id_user"]);
		foreach($infos as $user):
		endforeach;
		$modele = $this->getlastIdTweet($_SESSION["id_user"]);
		foreach($modele as $details):
		endforeach;
		$infos_img = pathinfo($_FILES["image_profil"]["name"]);
		extract($infos_img);
		$id_tweet = ($details['id_tweet']) + 1;
		$current_dir = dirname(__FILE__);
		mkdir($current_dir."\img");
		$dir = $current_dir."\img/";
		$image_name   = $user['id_user']."_".date('Y_m_d').".".$extension."";


		if($extension === "jpg" || $extension  === "png" || $extension === "jpeg")
		{
			if (is_uploaded_file($_FILES["image_profil"]["tmp_name"])) 
			{
				if (rename($_FILES["image_profil"]["tmp_name"], $dir.$image_name)) 
				{
					$upload->image_profil($image_name, $_SESSION['id_user']);
				} 
				else 
				{
					$_SESSION['error'] = "Erreur vérifiez l'existence du répertoire ".$dir."";
					include('../views/error.php');
				}    
			}
			else 
			{
				$_SESSION['error'] = "Le fichier n'a pas été uploadé (trop gros ?)";
				include('../views/error.php');
			}
		}
		else
		{

			$_SESSION['error'] = "Ceci n'est pas une image";
			include('../views/error.php');
		}
	}


	public function like()
	{
		var_dump($_POST);
		$check_duplicates = $this->getLike_status($_SESSION['id_user'], $_POST['id_tweet']);
			//var_dump($check_duplicates);
		if(!empty($check_duplicates))
		{
			foreach ($check_duplicates as $value) {
			}
			if($value['id_tweet'] !== $_POST['id_tweet'])
			{
				$this->likeTweet($_SESSION['id_user'], $_POST['id_tweet']);
			}
			else
			{
				if($value['status_like'] === '1')
				{
					$this->updateLike_status($_SESSION['id_user'], "0");
				}
				else
				{
					$this->updateLike_status($_SESSION['id_user'], "1");
				}
			}
		}


		else
		{
			$this->likeTweet($_SESSION['id_user'], $_POST['id_tweet']);

		}
	}


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
	}

}

if(isset($_POST['tweet']))
{
	$tweet = new tweet();
	$tools = new tools();
	$new_tweet = $tools->transformString($_POST['tweet']);
	preg_match_all('/#(\w+)/', $new_tweet, $array);

	if($_FILES['monfichier']['name'] !== "")
	{
		$tweet->uploadImg();
	}
	if(strlen($_POST['tweet']) < 140)
	{
		$tweet->sendTweet();
		$tweet->insertHashtag($array);
	}


}
if(isset($_POST['upload_img_profil']))
{
	if($_FILES['image_profil']['name'] !== "")
	{
		$tweet = new tweet();	
		$tweet->uploadImgProfil();
	}
}

elseif(isset($_GET['search']))
{
	extract($_GET);
	$check_hash = strstr($tag, '#');
	$check_at = strstr($tag, '@');
	if($check_hash !== false)
	{
		$search = new Search();
		$tools = new tools();
		$new_search = $tools->transformString($tag);
		preg_match_all('/#(\w+)/', $new_search, $tag);
		$result = $search->searchHashtag($tag);
	}
	else
	{
		$search = new Search();
		$result = $search->searchProfil($tag);
	}
}

if(isset($_POST['retweet']))
{
	$tweet = new tweet();
	$tweet->reTweet();
}

if(isset($_POST['like']))
{
	$tweet = new tweet();
	$tweet->like();
}

if(isset($_POST['follow']))
{
	$user = new tweet();
	$user->followMembers();
}


if(isset($_POST['comment']))
{	
	$c = strlen($_POST['content']);
	if($_POST['content'] == "" || ctype_space($_POST['content']))
	{
		$_SESSION['error'] = "Votre commentaire ne peut pas être vide.";
		include('../views/error.php');
	}
	elseif($c > 140)
	{
		$_SESSION['error'] = "Votre commentaire doit comporter moins de 140 caractères.";
		include('../views/error.php');
	}
	else
	{
		$user = new User();
		$user->addComment();
	}
}