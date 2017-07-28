<nav id="side-menu" class="menu">
    <img src="icons/hamburger.png">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="add_feed.php">Add a Feed</a></li>
		<div id="account-menu">
			<li><a href="settings.php">Settings</a></li>
			<li><a href="logout.php">Logout</a></li>
		</div><!--account-menu end-->
		<br>
		<div id="feeds-list">
			<?php
				//For each registered feed, create a button
				for($i = 0; $i < count($feeds); $i++)
				{	
					//Get feed_name
					$feed_name = DB::queryFirstField("SELECT feed_name FROM feeds WHERE feed_id=%d", $feeds[$i]["feed_id"]);
					echo "<button class=\"menu_feed\" value=\"" . $feeds[$i]["feed_id"] . "\" onclick=\"setFeed(this.value)\">" . htmlspecialchars($feed_name) . "</button>";
				}
			?>
		</div><!--feeds-list end-->
	</ul>
</nav>