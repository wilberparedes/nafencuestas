<?php
	session_start();
	if(isset($_SESSION["session"])){
		
	}else{
		header("Location: login.php");
	}

?>
