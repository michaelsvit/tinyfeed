<?php
	//Initialize MeekroDB
	require_once("meekrodb.2.3.class.php");
	DB::$user = "root";
	DB::$password = "";
	DB::$dbName = "database";
	
	//Functions
	function redirect($destination)
	{
		$protocol = "http";
		$host = $_SERVER["HTTP_HOST"];
		$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: $protocol://$host$path/$destination");
	}
	
	function apologize($message)
	{
		require 'html/apology_dom.php';
		exit;
	}
	
	//Start session
    session_start();

    // require authentication for most pages
    if(!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if(empty($_SESSION["id"]))
        {
            redirect("login.php");
        }
		else
		{
			//Grab registered feeds list from database for menu
			$feeds = DB::query("SELECT * FROM user_feeds WHERE user_id=%s", $_SESSION["id"]);
		}
    }
    else if(preg_match("{(?:login|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if(!empty($_SESSION["id"]))
        {
            apologize("Log out first!");
        }
    }
	
	//Global includes
	echo '<script type="text/javascript" src="js/set_feed.js"></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>';
    //echo '<script type="text/javascript" src="js/main.js"></script>';
?>