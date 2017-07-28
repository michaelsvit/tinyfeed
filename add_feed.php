<?php
	//Configuration
	require 'includes/config.php';

	//If form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//Check if new_feed is a URL
		if(preg_match('_^(?:(?:https?)://)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/\S*)?$_iuS', $_POST["new_feed"]))
		{
			//Verify it is a valid RSS feed
			//Ignore warnings
			error_reporting(E_ERROR | E_PARSE);
			
			$xmlDoc = file_get_contents($_POST["new_feed"]);
			try
			{
				$rss = new SimpleXmlElement($xmlDoc);
				
				if(!isset($rss->channel->item) || $rss->channel->item->count() == 0)
				{
					throw new Exception("The URL is not a valid RSS feed!");
				}
			}
			catch(Exception $e)
			{
				error_reporting(E_ALL);
				apologize("The URL is not a valid RSS feed!");
			}
			
			//Get channel name
			$feed_name = (string)$rss->channel->title;
			
			//Add new feed to list in database if it doesn't exit
			$feed = DB::queryFirstRow("SELECT * FROM feeds WHERE feed_name=%s", $feed_name);
			$new_feed_id = null;
			if(empty($feed))
			{
				DB::query("INSERT INTO feeds (feed_name, feed_url) VALUES (%s, %s)", $feed_name, $_POST["new_feed"]);
				$new_feed_id = DB::insertId();
			}
			else
			{
				$new_feed_id = $feed["feed_id"];
			}
			
			//Add new feed to current user's registered feeds if it doesn't exit
			$user_feed = DB::query("SELECT * FROM user_feeds WHERE user_id=%s AND feed_id=%s", $_SESSION["id"], $new_feed_id);
			if(empty($user_feed))
			{
				DB::query("INSERT INTO user_feeds (user_id, feed_id) VALUES(%s, %s)", $_SESSION["id"], $new_feed_id);
			}
			else
			{
				apologize("You are already registered to this feed!");
			}
		}
		else
		{
			//Check if feed name exists in database
			$feed = DB::queryFirstRow("SELECT * FROM feeds WHERE feed_name=%s", $_POST["new_feed"]);
			if(empty($feed))
			{
				apologize("The input was not a valid URL or a name that exists in the database!");
			}
			else
			{
				//Check if user is already registered to this feed
				$user_feed = DB::query("SELECT * FROM user_feeds WHERE user_id=%s AND feed_id=%d", $_SESSION["id"], $feed["feed_id"]);
				if(empty($user_feed))
				{
					//Add new feed to current user's registered feeds
					DB::query("INSERT INTO user_feeds (user_id, feed_id) VALUES(%s, %s)", $_SESSION["id"], $feed["feed_id"]);
				}
				else
				{
					apologize("You are already registered to this feed!");
				}
			}
		}
		
		//Redirect to home page
		redirect('index.php');
	}
	else
	{
		//Render DOM
		require 'html/add_feed_dom.php';
	}
?>