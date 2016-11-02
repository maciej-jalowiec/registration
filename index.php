<?php

class User {

	public $regName;
	public $regUsername;
	public $regEmail;
	public $regPassword;

	public function __construct (
		$regName,
		$regUsername,
		$regEmail,
		$regPassword) {
			$this->regName = $regName;
			$this->regUsername = $regUsername;
			$this->regEmail = $regEmail;
			$this->regPassword = $regPassword;
	}

	public function displayUser() {
		echo "Your name is ".$this->regName.", your username is ".$this->regUsername.", and your email is ".$this->regEmail.".";
	}

	public function pushToDatabase() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "registered_users";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: ".$conn->connect_error);
		}

		$query = "INSERT INTO users(name, username, email, password) VALUES (
			'$this->regName',
			'$this->regUsername',
			'$this->regEmail',
			'$this->regPassword'
			)";
		if ($conn->query($query) === TRUE) {
			echo " Congratulations, registration is complete!";
		}
		else {
			echo "error: ".$conn->error;
		}
		$conn->close();
	}
}



?>

<html>
	<head><title>Registration</title></head>
	<body>
	<?php if(!isset($_POST['submit']) OR !isset($_POST['name']) OR !isset($_POST['username']) OR !isset($_POST['email']) OR !isset($_POST['password'])) { ?>
		<p>Please fill in the form below. * indicates a required field.</p>
		<form method="post" action="index.php">
		<p>Name* <input type="text" name="name" /></p>
		<p>Username* <input type="text" name="username" /></p>
		<p>Email* <input type="text" name="email" /></p>
		<p>Password* <input type="password" name="password" /></p>
		<p>Repeat password* <input type="password" name="passwordRepeat" /></p>

		<input type="submit" name="submit" value="submit" />
		</form>
	<?php }
	else {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordRepeat = $_POST['passwordRepeat'];

		if (empty($name) OR empty($username) OR empty($email) OR empty($passwordRepeat)) {
			echo "<p>You did not fill out the necessary info! <button onclick=\"history.go(-1);\">Back</button></p>";
		}
		else {
			if ($password != $passwordRepeat) {
				echo "The passwords don't match! <button onclick=\"history.go(-1);\">Back</button></p>";
			}
			if (!strpos($email, '@')) {
				echo "Invalid email address! <button onclick=\"history.go(-1);\">Back</button></p>";
			}
			else {
				echo "<p>Here's your data:</p>
				<p>Name: ".$name."</p>
				<p>Username: ".$username."</p>
				<p>Email: ".$email."</p>";

				$newuser = new User($name, $username, $email, $password);

				echo $newuser->displayUser();
				$newuser->pushToDatabase();
			}
		}
	} ?>
	</body>
</html>