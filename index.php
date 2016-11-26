<?php

session_start();
require ('connection.php');
include 'chromePhp.php';

	//ChromePhp::log(stream_get_transports(void));

function format_email($info, $format) {
 
    //set the root
    $root = $_SERVER['DOCUMENT_ROOT'].'/registration/email_templates';

    //grab the template content
    $template = file_get_contents($root.'/signup_template.'.$format);

    //replace all the tags
    $template = preg_replace('{NAME}', $info['name'], $template);
    $template = preg_replace('{EMAIL}', $info['email'], $template);
    $template = preg_replace('{KEY}', $info['key'], $template);
    $template = preg_replace('{SITEPATH}','localhost/registration', $template);
         
    //return the html of the template
    return $template;

}

function send_email($info) {
         
    //format each email
    $body = format_email($info,'html');
    $body_plain_txt = format_email($info,'txt');
 
    //setup the mailer
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
		->setUsername('maciej.jalowiec@gmail.com')
		->setPassword('LepperHimmler123');
    $mailer = Swift_Mailer::newInstance($transport);
    $message = Swift_Message::newInstance('Confirm Yo Email')
    	->setFrom(array('maciej.jalowiec@gmail.com' => 'Site Name'))
    	->setTo(array($info['email'] => $info['name']))
    	->setBody($body_plain_txt)
    	->addPart($body, 'text/html');

    $result = $mailer->send($message);

    return $result;
     
}

class User {

	public $regName;
	public $regUsername;
	public $regEmail;
	public $regPassword;
	public $regKey;

	public function __construct (
		$regName,
		$regUsername,
		$regEmail,
		$regPassword,
		$regKey) {
			$this->regName = $regName;
			$this->regUsername = $regUsername;
			$this->regEmail = $regEmail;
			$this->regPassword = $regPassword;
			$this->regKey = $regKey;
	}

	public function pushToDatabase($conn) {
		$query = "INSERT INTO users(name, username, email, password, email_key) VALUES (
			'$this->regName',
			'$this->regUsername',
			'$this->regEmail',
			'$this->regPassword',
			'$this->regKey'
			)";
		if ($conn->query($query) === TRUE) {
			ChromePhp::log("Congratulations, registration is complete!");
		}
		else {
			ChromePhp::log("error: ".$conn->error);
		}
		$conn->close();
	}
}



?>

<html>
	<head><title>Registration</title></head>
	<body>
	<?php if(!isset($_POST['submit']) OR !isset($_POST['name']) OR !isset($_POST['username']) OR !isset($_POST['email']) OR !isset($_POST['password'])) { ?>
		<p>Please fill in the form below.</p>
		<form method="post" action="index.php">
		<p>Name <input type="text" name="name" /></p>
		<p>Username <input type="text" name="username" /></p>
		<p>Email <input type="text" name="email" /></p>
		<p>Password <input type="password" name="password" /></p>
		<p>Repeat password <input type="password" name="passwordRepeat" /></p>

		<input type="submit" name="submit" value="submit" />
		</form>
	<?php }
	else {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordRepeat = $_POST['passwordRepeat'];

		$digits='/[0-9]/';
		$chars='/[\$\!\@\?\<\>\[\]\{\}\#\%\^\&\*\(\)]/';
		$capitals='/[A-Z]/';

		$loginCheck = "SELECT * FROM users WHERE username='".$_POST['username']."'";
		$resultLoginCheck = $conn->query($loginCheck);

		$emailCheck = "SELECT * FROM users WHERE email='".$_POST['email']."'";
		$resultEmailCheck = $conn->query($emailCheck);

		$steps_passed = 0;

		if (empty($name) OR empty($username) OR empty($email) OR empty($passwordRepeat)) {
			echo "<p>You did not fill out the necessary info!<br>";
		}
		else {$steps_passed++;}

		if (strpbrk($name, $chars) OR strpbrk($username, $chars)) {
			echo "The name or username contains forbidden characters!<br>";
		}
		else {$steps_passed++;}

		if ($password != $passwordRepeat) {
			echo "The passwords don't match!<br>";
		}
		else {$steps_passed++;}

		if (strlen($password) < 8) {
			echo "The password is too short!<br>";
		}
		else {$steps_passed++;}

		if (!preg_match($digits, $password) OR !preg_match($chars, $password) OR !preg_match($capitals, $password)) {
			echo "Make sure the password has one capital character, one digit and one special character!<br>";
		}
		else {$steps_passed++;}

		if (!strpbrk($email, '@.')) {
			echo "Invalid email address!<br>";
		}
		else {$steps_passed++;}

		if ($resultLoginCheck->num_rows != 0) {
			echo "This username is already taken!<br>";
		}
		else {$steps_passed++;}

		if ($resultEmailCheck->num_rows != 0) {
			echo "This email is already taken!<br>";
		}
		else {$steps_passed++;}

		if ($steps_passed < 8) {
			echo "<button onclick=\"history.go(-1);\">Back</button></p>";
		}
		else {
			$password = password_hash ($password, PASSWORD_DEFAULT);

			$emailKey = $username . $email . date('mY');
			$emailKey = md5($emailKey);

			$newuser = new User($name, $username, $email, $password, $emailKey);
			include_once 'swiftmailer/lib/swift_required.php';
			
			$info = array(
			    'name' => $name,
			    'email' => $email,
			    'key' => $emailKey
			);

			if(send_email($info)){
				$newuser->pushToDatabase($conn);
				header("Location: thank_you.php");
			}
			else {			                     
				echo "There was a problem with sending out a confirmation email! <button onclick=\"history.go(-1);\">Back</button></p>";
			}
		}
	} ?>
	</body>
</html>