<?php

$browsers = array(
	"Firefox",
	"Chrome",
	"Internet Explorer",
	"Opera",
	"Safari",
	"Other"
	);

$speeds = array(
	"Unknown",
	"DSL",
	"T1",
	"Cable",
	"Dialup",
	"Other"
	);

$os = array(
	"Windows",
	"Linux",
	"Macintosh",
	"Other"
	);


class Select {
	private $name;
	private $value;

	public function setName ($name) {
		$this->name = $name;
	}

	public function getName () {
		return $this->name;
	}

	public function setValue ($value) {
		if (is_array($value)) {
			$this->value = $value;
		}
		else {
			echo '<p>Error: the $value is not an array.</p>';
		}
	}

	public function getValue () {
		return $this->value;
	}

	private function makeOption ($arr) {
		foreach ($arr as $str) {
			echo '<option value="'.$str.'">'.ucfirst($str).'</option>';	
		}
		
	}

	public function makeSelect () {
		echo '<select name="'.$this->getName().'">';
		echo '<option value="No response">--Select one--</option>';
		$this->makeOption($this->getValue());
		echo '</select>';
	}

}

class User {

	public $regName;
	public $regUsername;
	public $regEmail;
	public $regWorkBrowser;
	public $regWorkSpeed;
	public $regWorkSystem;
	public $regHomeBrowser;
	public $regHomeSpeed;
	public $regHomeSystem;

	public function __construct (
		$regName,
		$regUsername,
		$regEmail,
		$regWorkBrowser,
		$regWorkSpeed,
		$regWorkSystem,
		$regHomeBrowser,
		$regHomeSpeed,
		$regHomeSystem) {
			$this->regName = $regName;
			$this->regUsername = $regUsername;
			$this->regEmail = $regEmail;
			$this->regWorkBrowser = $regWorkBrowser;
			$this->regWorkSpeed = $regWorkSpeed;
			$this->regWorkSystem = $regWorkSystem;
			$this->regHomeBrowser = $regHomeBrowser;
			$this->regHomeSpeed = $regHomeSpeed;
			$this->regHomeSystem = $regHomeSystem;
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

		$query = "INSERT INTO users(name, username, email, workBrowser, workSpeed, workSystem, homeBrowser, homeSpeed, homeSystem) VALUES (
			'$this->regName',
			'$this->regUsername',
			'$this->regEmail',
			'$this->regWorkBrowser',
			'$this->regWorkSpeed',
			'$this->regWorkSystem',
			'$this->regHomeBrowser',
			'$this->regHomeSpeed',
			'$this->regHomeSystem'
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
	<?php if(!isset($_POST['submit'])) { ?>
		<p>Please fill in the form below. * indicates a required field.</p>
		<form method="post" action="index.php">
		<p>Name* <input type="text" name="name" /></p>
		<p>Username* <input type="text" name="username" /></p>
		<p>Email* <input type="text" name="email" /></p>
		<h4>Work access:</h4>
		<p>Primary browser: <?php
			$workBrowser = new Select();
			$workBrowser->setName('workBrowser');
			$workBrowser->setValue($browsers);
			$workBrowser->makeSelect(); ?></p>

		<p>Connection speed: <?php
			$workSpeed = new Select();
			$workSpeed->setName('workSpeed');
			$workSpeed->setValue($speeds);
			$workSpeed->makeSelect(); ?></p>

		<p>Operating system: <?php
			$workSystem = new Select();
			$workSystem->setName('workSystem');
			$workSystem->setValue($os);
			$workSystem->makeSelect(); ?></p>

		<h4>Home access:</h4>
		<p>Primary browser: <?php
			$homeBrowser = new Select();
			$homeBrowser->setName('homeBrowser');
			$homeBrowser->setValue($browsers);
			$homeBrowser->makeSelect(); ?></p>

		<p>Connection speed: <?php
			$homeSpeed = new Select();
			$homeSpeed->setName('homeSpeed');
			$homeSpeed->setValue($speeds);
			$homeSpeed->makeSelect(); ?></p>

		<p>Operating system: <?php
			$homeSystem = new Select();
			$homeSystem->setName('homeSystem');
			$homeSystem->setValue($os);
			$homeSystem->makeSelect(); ?></p>

		<input type="submit" name="submit" value="submit" />
		</form>
	<?php }
	else {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$workBrowser = $_POST['workBrowser'];
		$workSpeed = $_POST['workSpeed'];
		$workSystem = $_POST['workSystem'];
		$homeBrowser = $_POST['homeBrowser'];
		$homeSpeed = $_POST['homeSpeed'];
		$homeSystem = $_POST['homeSystem'];

		if (empty($name) OR empty($username) OR empty($email)) {
			echo "<p>You did not fill out the necessary info! <button onclick=\"history.go(-1);\">Back</button></p>";
		}
		else {
			if (!strpos($email, '@')) {
				echo "Invalid email address! <button onclick=\"history.go(-1);\">Back</button></p>";
			}
			else {
				echo "<p>Here's your data:</p>
				<p>Name: ".$name."</p>
				<p>Username: ".$username."</p>
				<p>Email: ".$email."</p>
				<p>Work access: </p>
				<ul>
				<li>".$workBrowser."</li>
				<li>".$workSpeed."</li>
				<li>".$workSystem."</li>
				</ul>
				<p>Home access: </p>
				<ul>
				<li>".$homeBrowser."</li>
				<li>".$homeSpeed."</li>
				<li>".$homeSystem."</li>
				</ul>";

				$newuser = new User($name, $username, $email, $workBrowser, $workSpeed, $workSystem, $homeBrowser, $homeSpeed, $homeSystem);

				echo $newuser->displayUser();
				$newuser->pushToDatabase();
			}
		}
	} ?>
	</body>
</html>