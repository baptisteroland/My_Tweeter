<?php
include('../controller/bdd.php');

class Theme extends Database
{
	public function getThemeUser($id_user)
	{
		$theme = $this->select("theme", "user WHERE id_user = ".$id_user."");
		return $theme;
	}

	public function changeTheme($id_user, $theme)
	{
		$change = $this->update("user", "theme = '".$theme."'", "id_user = ".$id_user."");
		$change->execute();
		echo "ok";
		header('Location: ../views/modif_profil.php');
	}
}