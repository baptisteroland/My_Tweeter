<?php
include('../modele/theme.php');


class Theme_Control
{
	public function control()
	{
		extract($_POST);
		$new_theme = "";

		switch($theme)
		{

		case "css/theme_default/modif_profil":
		$new_theme = "#E4ECEF";
		break;

		case "css/theme_silver/modif_profil":
		$new_theme = "#C7C3B4";
		break;

		case "css/theme_pink/modif_profil":
		$new_theme = "#FEEAFB";
		break;
		}
		
		return $new_theme;
	}

	}

if($_POST['change_theme'])
{
	$theme = new Theme_Control();
	$new_theme = $theme->control();
	$change = new Theme();
	$change->changeTheme($_SESSION['id_user'], $new_theme);
}