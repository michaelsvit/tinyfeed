<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		
		<title>Log In</title>
	</head>
	<body>
		<div id="wrapper">
			<header>
				<h1>Tiny Feed</h1>
			</header>
			<main>
                <form id="login-form" action="login.php" method="post">
                    <p>Please enter the following information:</p>
                    <input autofocus required type="text" name="username" id="username" placeholder="User Name">
                    <input required type="password" name="password" id="password" placeholder="Password">
                    <input type="submit" value="Submit">
                </form>
			</main>
			<aside>
				<br>
				<p>Or <a href="register.php">register</a> a new account instead!</p>
			</aside>
		</div><!--wrapper end-->
	</body>
</html>