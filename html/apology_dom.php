<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		
		<title>Apology</title>
	</head>
	<body>
		<div id="wrapper">
			<?php
				if(isset($_SESSION["id"]))
				{
					require 'includes/side_menu.php';
				}
			?>
			<section id="right">
				<header>
					<h1>Tiny Feed</h1>
				</header>
				<main>
					<p><?php echo htmlspecialchars($message); ?></p>
					<a href="javascript:history.back()">Back</a>
				</main>
			</section>
		</div><!--wrapper end-->
	</body>
</html>