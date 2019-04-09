<?php 
class tools
{
	public function hashPassword($password)
	{
		$salt = 'si tu aimes la wac tape dans tes mains';
		$password = $salt.$password;
		$password_hash = hash('ripemd160', $password);
		return $password_hash;
	}


	public function calculate_days($date_actual, $date_comment)

	{

		$date_comment = strtotime($date_comment);
		$date_actual = strtotime($date_actual);

	// On récupère la différence de timestamp
		$nb_days = $date_actual - $date_comment;

	// On sait que 1 heure = 60 secondes 60 minutes et que 1 jour = 24 heures donc :
	$nb = $nb_days/86400; // 86 400 = 6060*24

	if($nb <= 0)
	{
		$result = "Aujourd'hui";
	}
	elseif($nb >= 7 AND $nb < 30)
	{
		$week = $nb/7;
		$result = "Il y a environ ".round($week)." semaines";

	}
	elseif($nb >= 30 AND $nb < 365)
	{
		$month = $nb/30;
		$result = "Il y a environ  ".round($month)." mois";
	}
	elseif($nb >= 365)
	{
		$year = $nb/365;
		$result = "Il y a environ  ".round($year)." ans";
	}

	else
	{
		$result = "Posté il y a ".$nb."j";
	}

	return $result;
}

	/*
	$0 correspond à $string avant preg_replace;
	$1 coresspond à $string après preg_replace;
	*/
	public function getHashtag($string)  
	{  
		$expression = "/#+([a-zA-Z0-9_]+)/";
		$string = preg_replace($expression, '<a href="../controller/functions.php?tag=%23$1&search_tag">$0</a>', $string); 
		return $string;  
	}  

	public function targetProfil($string)  
	{  
		$expression = "/@+([a-zA-Z0-9_]+)/";
		$string = preg_replace($expression, '<a href="profil.php?pseudo=$1">$0</a>', $string); 
		return $string;  
	}
	public function transformString($string)
	{
		$string = $this->getHashtag($string);
		$string = $this->targetProfil($string);
		return $string;
	}
}