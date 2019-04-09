
<?php
//var_dump($_SESSION);
class erreur
{
	public function message($msg)
	{
		return $msg;
	}
}

		$error = new erreur();
		$msg = $error->message($_SESSION['error']);
		echo $msg;
unset($_SESSION['error']);


?>
<script>		
	var test = "<?php echo $msg ?>";
		alert(test);
		history.go(-1);
	</script>



<?php 
?>