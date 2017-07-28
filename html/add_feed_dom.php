<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	
		<title>Add a Feed</title>
	</head>
	<body>
		<div id="wrapper">
			<?php require 'includes/side_menu.php'; ?>
			<section id="right">
				<header>
					<h1 id="title">Tiny Feed</h1>
				</header>
				<main id="main">
					<form id="add-feed-form" action="add_feed.php" method="post">
						<p>Search our database for a feed using keywords, or enter a URL:</p>
						<input list="feeds" name="new_feed" autocomplete="off">
						<datalist id="feeds">
							<!--output feeds from variable to html-->
							<?php
								//Get feeds from database
								$feed_list = DB::query("SELECT * FROM feeds");
								for($i = 0; $i < count($feed_list); $i++)
								{
									echo "<option value=\"" . htmlspecialchars($feed_list[$i]["feed_name"]) . "\">";
								}
							?>
						</datalist>
						<input type="submit" value="Submit">
					</form>
				</main>
			</section>
		</div><!--wrapper end-->
	</body>
</html>