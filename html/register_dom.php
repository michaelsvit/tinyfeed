<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/register.js"></script>
		
		<title>Register</title>
	</head>
	<body>
		<div id="wrapper">
			<header>
				<h1>Tiny Feed</h1>
			</header>
			<main>
				<p>Please fill the following fields to register a new account:</p>
				<form action="register.php" method="post">
					<input autofocus required type="text" name="username" id="username" placeholder="User Name">
					<span id="user_exists"></span>
					<input required type="password" name="password" id="password" placeholder="Password"
					onkeyup="checkPass(); return false;">
					<input required type="password" name="password_confirm" id="password_confirm" placeholder="Confirm Password"
					onkeyup="checkPass(); return false;">
					<span id="confirmMessage"></span>
					<input type="submit" value="Submit" onclick="return checkPassSubmit();">
				</form>
			</main>
			<aside>
				<br>
				<p>Or <a href="login.php">login</a> using an existing account instead!</p>
			</aside>
		</div><!--wrapper end-->
	</body>
</html>