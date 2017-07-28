<?php
	//Include config
	require("includes/config.php");
	
	//If form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//Check if user already exists
		if(is_null(DB::queryFirstField("SELECT username FROM users WHERE username=%s", $_POST["username"])))
		{
			//Register the new user
			DB::query("INSERT INTO users (username, password) VALUES (%s, %s)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
			//Save user id in $_SESSION to keep user logged in
			$_SESSION["id"] = DB::insertId();
			redirect("index.php");
		}
		else
		{
			//Username already exists, prompt user
			$html = new DOMDocument();
			$html->loadHTMLFile('html/register_dom.php');
			$html->getElementById('user_exists')->nodeValue = 'Username already exists!';
			echo htmlspecialchars($html);
		}
	}
	else
	{
		require("html/register_dom.php");
	}
?>