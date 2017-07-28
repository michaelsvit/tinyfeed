<?php
	//Configuration
	require '../includes/config.php';

	//get the parameter from URL
	$feed_id=$_GET["q"];
	
	//find out which feed was selected
	$feed = DB::queryFirstRow("SELECT * FROM feeds WHERE feed_id=%d", $feed_id);

	$xmlDoc = new DOMDocument();
	$xmlDoc->load($feed["feed_url"]);

	//get elements from "<channel>"
	$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
	$channel_title = $channel->getElementsByTagName('title')
	->item(0)->childNodes->item(0)->nodeValue;
	$channel_link = $channel->getElementsByTagName('link')
	->item(0)->childNodes->item(0)->nodeValue;
	$channel_desc = $channel->getElementsByTagName('description')
	->item(0)->childNodes->item(0)->nodeValue;

	//output elements from "<channel>"
	$html = "<p id='feed_header'><a href='" . $channel_link . "' id='feed_title'>" . $channel_title . "</a>";
	$html .= "<br>" . $channel_desc . "</p>";

	//get and output "<item>" elements
	$x=$xmlDoc->getElementsByTagName('item');
	
	//Get the index to start loading from
	$start_index = 0;
	if(isset($_SESSION["feed_last_item"][$feed_id]))
	{
		$start_index = $_SESSION["feed_last_item"][$feed_id];
	}
	
	foreach($x as $item)
	{
		$item_title = $item->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
		$item_link = $item->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
		$item_desc = $item->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
		$html .= "<article dir='auto'>";
		$html .= "<p><a class=\"article-title\" href='" . $item_link . "'>" . $item_title . "</a>";
		$html .= "<br>" . $item_desc . "</p>";
		$html .= "</article>";
	}
	
	//Change main section's inner html
	echo $html;
	
	//Save last feed output item
	$_SESSION["feed_last_item"][$feed_id] = $start_index + 10;
?>