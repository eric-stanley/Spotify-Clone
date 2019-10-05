<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($username, $password) {
			$password = md5($password);
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$username' AND password='$password'");

			if (mysqli_num_rows($query) == 1) {
				return true;
			} else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		public function register($username, $firstName, 
				$lastName, $email, $emailConfirm, 
				$password, $passwordConfirm) {
			$this->validateUserName($username);
			$this->validateFirstName($firstName);
			$this->validateLastName($lastName);
			$this->validateEmails($email, $emailConfirm);
			$this->validatePasswords($password, $passwordConfirm);

			if (empty($this->errorArray)) {
				//Insert into db
				return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
			} else {
				return false;
			}
		}

		public function getError($error) {
			if (!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($username, $firstName, $lastName, $email, $password) {
			$encryptedPassword = md5($password);
			$profilePic = "assets/images/profile-pics/user.png";
			$date = date("Y-m-d");

			$result = mysqli_query($this->con, "INSERT INTO users (username, firstname, lastname, email, password, signup_date, profile_pic) VALUES ('$username', '$firstName', '$lastName', '$email', '$encryptedPassword', '$date', '$profilePic')");
			
			return $result;
		}

		private function validateUserName($username) {
			if (strlen($username) > 25 || strlen($username) < 5) {
				array_push($this->errorArray, Constants::$userNameCharacters);
				return;
			}

			$checkUserNameQuery = mysqli_query($this -> con, "SELECT username from users WHERE username = '$username'");
			if (mysqli_num_rows($checkUserNameQuery) != 0) {
				array_push($this->errorArray, Constants::$userNameTaken);
				return;
			}
		}

		private function validateFirstName($firstName) {
			if (strlen($firstName) > 25 || strlen($firstName) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($lastName) {
			if (strlen($lastName) > 25 || strlen($lastName) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		}

		private function validateEmails($email, $emailConfirm) {
			if ($email != $emailConfirm) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
				return;
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return;
			}

			$checkEmailQuery = mysqli_query($this -> con, "SELECT username from users WHERE email = '$email'");
			if (mysqli_num_rows($checkEmailQuery) != 0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return;
			}
		}

		private function validatePasswords($password, $passwordConfirm) {
			if ($password != $passwordConfirm) {
				array_push($this->errorArray, Constants::$passwordsDoNotMatch);
				return;
			}

			if (preg_match('/[^A-Za-z0-9]/', $password)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}

			if (strlen($password) > 30 || strlen($password) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
			
		}


	}
?>
