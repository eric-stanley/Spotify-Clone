<?php

if (isset($_POST['loginButton'])) {
	//login button was pressed
}

if (isset($_POST['registerButton'])) {
	//register button was pressed
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spotify!</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>

			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. ericStanley" required>	
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>	
			</p>

			<button type="submit" name="loginButton">LOG IN</button>
			
		</form>


		<form id="registerForm" action="register.php" method="POST">
			<h2>Create your free account</h2>

			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="e.g. ericStanley" required>	
			</p>

			<p>
				<label for="firstName">First Name</label>
				<input id="firstName" name="firstName" type="text" placeholder="e.g. Eric" required>	
			</p>

			<p>
				<label for="lastName">Last Name</label>
				<input id="lastName" name="lastName" type="text" placeholder="e.g. Stanley" required>	
			</p>

			<p>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. eric@gmail.com" required>	
			</p>

			<p>
				<label for="emailConfirmation">Confirm Email</label>
				<input id="emailConfirmation" name="emailConfirmation" type="email" placeholder="e.g. eric@gmail.com" required>	
			</p>

			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="Your password" required>	
			</p>

			<p>
				<label for="passwordConfirm">Confirm Password</label>
				<input id="passwordConfirm" name="passwordConfirm" type="password" placeholder="Your password" required>	
			</p>

			<button type="submit" name="registerButton">SIGN UP</button>
			
		</form>

	</div>

</body>
</html>