<?php

include 'chromePhp.php';

	session_start();
	$error='';

	if (isset($_SESSION['login_user'])) {
		header("location: profile.php");
	}

?>

<html>
	<head><title>Login</title></head>
	<body>
		<?php 
			if (!isset($_POST['submit'])) { ?>
				<form method="post" action="login.php">
					<p>Email: <input name="email" type="text"></p>
					<p>Password: <input name="password" type="password"></p>
					<input type="submit" name="submit" value="Login">
				</form>
			<?php }
			else {
				if (empty($_POST['email']) OR empty($_POST['password'])) {
					echo "<p>Please input email and password. <button onclick=\"history.go(-1);\">Back</button></p>";
				}
				else {
					$email = stripslashes($_POST['email']);
					$password = stripslashes($_POST['password']);

					require ('connection.php');

					$check_query = "SELECT * FROM users WHERE email = '$email'";
					$login_check = $conn->query($check_query);
					$row_count = $login_check->num_rows;

					if ($row_count == 1) {
						$user_data = mysqli_fetch_assoc($login_check);
						if (password_verify($password, $user_data['password'])) {
							$_SESSION['login_user'] = $user_data['email'];
							$conn->close();
							header("location: profile.php");
						}
						else {
							echo "<p>Password invalid. <button onclick=\"history.go(-1);\">Back</button></p>";
						}
					}
					else if ($row_count == 0) {
						echo "<p>Email invalid. <button onclick=\"history.go(-1);\">Back</button></p>";
					}
					else {
						echo "<p>Error, contact administrator. <button onclick=\"history.go(-1);\">Back</button></p>";	
					}
				}
			} ?>
	</body>
</html>