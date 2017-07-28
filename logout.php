<?php
	//Include config
	require("includes/config.php");
	
	//Empty session information
	$_SESSION = [];
	
	//Expire cookie
	if (!empty($_COOKIE[session_name()]))
	{
		setcookie(session_name(), "", time() - 42000);
	}

	//Destroy session
	session_destroy();
	
	//Redirect to home page
	redirect('index.php')
?>