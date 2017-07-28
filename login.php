<?php
	//Include config
	require("includes/config.php");
	
	//If form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//Search for user in the database
		$user = DB::queryFirstRow("SELECT * FROM users WHERE username = %s", $_POST["username"]);
		if(!empty($user))
		{
			//Check if password matches the database
			if(password_verify($_POST["password"], $user["password"]))
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $user["user_id"];

                // redirect to home
                redirect("index.php");
            }
			apologize("Username and password do not match!");
		}
		apologize("Username does not exist!");
	}
	else
	{
		require("html/login_dom.php");
	}
?>