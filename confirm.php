<?php

session_start();
require('connection.php');
include 'chromePhp.php';
?>

<html>
	<head><title>Registration</title></head>
	<body>

	<?php

		if(empty($_GET['email']) OR empty($_GET['key'])) {
			echo "Something went wrong. Please check if you pasted the link into your browser correctly.";
		}
		else {
			$email = $_GET['email'];
			$key = $_GET['key'];

			$check_query = "SELECT * FROM users WHERE email = '$email' AND email_key = '$key' AND email_confirm = 0 LIMIT 1";
			$key_check = $conn->query($check_query);
			$row_count = $key_check->num_rows;

			if ($row_count == 1) {
				$confirm_query = "UPDATE users SET email_confirm = 1 WHERE email = '$email' AND email_key = '$key' LIMIT 1";
				$conn->query($confirm_query);
				$conn->close();
				echo "Thank you for confirming your email! You will be now taken to login page.";
				header("Location: login.php");
			}
			else {
				echo "This email is already confirmed.";
				
			}
		}

	?>
	</body>
</html>