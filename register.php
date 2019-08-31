<?php

	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if (isset($_POST[$name])) {
			echo $_POST[$name];
		}
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
				<?php echo $account -> getError(Constants::$loginFailed); ?>
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
				<?php echo $account -> getError(Constants::$userNameCharacters); ?>
				<?php echo $account -> getError(Constants::$userNameTaken); ?>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="e.g. ericStanley" value="<?php getInputValue('username'); ?>" required>	
			</p>

			<p>
				<?php echo $account -> getError(Constants::$firstNameCharacters); ?>
				<label for="firstName">First Name</label>
				<input id="firstName" name="firstName" type="text" placeholder="e.g. Eric" value="<?php getInputValue('firstName'); ?>" required>	
			</p>

			<p>
				<?php echo $account -> getError(Constants::$lastNameCharacters); ?>
				<label for="lastName">Last Name</label>
				<input id="lastName" name="lastName" type="text" placeholder="e.g. Stanley" value="<?php getInputValue('lastName'); ?>" required>	
			</p>

			<p>
				<?php echo $account -> getError(Constants::$emailInvalid); ?>
				<?php echo $account -> getError(Constants::$emailsDoNotMatch); ?>
				<?php echo $account -> getError(Constants::$emailTaken); ?>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. eric@gmail.com" value="<?php getInputValue('email'); ?>" required>	
			</p>

			<p>
				<label for="emailConfirm">Confirm Email</label>
				<input id="emailConfirm" name="emailConfirm" type="email" placeholder="e.g. eric@gmail.com" value="<?php getInputValue('emailConfirm'); ?>" required>	
			</p>

			<p>
				<?php echo $account -> getError(Constants::$passwordsDoNotMatch); ?>
				<?php echo $account -> getError(Constants::$passwordNotAlphanumeric); ?>
				<?php echo $account -> getError(Constants::$passwordCharacters); ?>
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