<?php

	session_start();
	include 'chromePhp.php';
	require ('connection.php');

	if (!isset($_SESSION['login_user'])) {
		header("location: login.php");
	}

?>
<html>
	<head><title>Your Profile</title></head>
	<body>
		You are logged in!
		<p><form action="logout.php">
    		<input type="submit" value="Logout" />
		</form></p>

		<?php if(!isset($_POST['submit'])) { 
			$check_query = "SELECT * FROM users WHERE email='".$_SESSION['login_user']."'";
			$login_check = $conn->query($check_query);
			$row_count = $login_check->num_rows;

			if ($row_count != 1) {
				echo "<p>Error! Contact administrator!</p>";
			}
			else {
				$user_data = mysqli_fetch_assoc($login_check);
				if ($user_data['weight'] != NULL OR
					$user_data['height'] != NULL OR
					$user_data['age'] != NULL OR
					$user_data['gender'] != NULL OR
					$user_data['activity'] != NULL OR
					$user_data['data_timestamp'] != NULL) {
					header("location: plans.php");
				}
				else { ?>
					<p>To get started, we will need a few more pieces of info from you.</p>
					<form method="post" action="profile.php">
			  			<p>Your weight (kgs): <input name="weight" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></p>
			  			<p>Your height (cms): <input name="height" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></p>
			  			<p>Age (years): <input name="age" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></p>
			  			<p>Gender: <input type="radio" name="gender" value="female" checked> Female <input type="radio" name="gender" value="male"> Male</p>
			  			<p>Which sentence describes your activity level best?<br>
							<input type="radio" name="activity" value="1" checked> I sit at a desk for most of the time and do small exercises from time to time<br>
							<input type="radio" name="activity" value="2"> I sit for most of the time, but also work out intensively 2-3 times per week<br>
							<input type="radio" name="activity" value="3"> I lead a very active lifestyle (physical labor and/or doing lots of sports)</p>
						<input type="submit" name="submit" value="Proceed!">
					</form> 
				<?php }
			}
		}
		else {
			$weight = $_POST['weight'];
			$height = $_POST['height'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$activity = $_POST['activity'];
			$data_timestamp = date('Y-m-d H:i:s');

			$steps_passed = 0;

			if (empty($weight) OR empty($height) OR empty($age) OR empty($gender) OR empty($activity)) {
				echo "<p>You did not fill out the necessary info!<br>";
			}
			else {$steps_passed++;}

			if (!is_numeric($weight) OR !is_numeric($height) OR !is_numeric($age)) {
				echo "Make sure that weight, height and age are numbers!<br>";
			}
			else {$steps_passed++;}

			if ($weight < 20 OR $weight > 300) {
				echo "Make sure to input correct weight!<br>";
			}
			else {$steps_passed++;}

			if ($height < 50 OR $height > 250) {
				echo "Make sure to input correct height!<br>";
			}
			else {$steps_passed++;}

			if ($age < 16 AND !empty($age)) {
				echo "Sorry, you have to be at least 16 to use this tool.<br>";
			}
			else {$steps_passed++;}

			if ($age > 120) {
				echo "Make sure to input correct age!<br>";
			}
			else {$steps_passed++;}

			if ($steps_passed < 6) {
				echo "<button onclick=\"history.go(-1);\">Back</button></p>";
			}
			else {
				$bmr = 10 * $weight +6.25 * $height - 5 * $age;
				if ($gender == "male") {
					$bmr += 161;
				}
				$bmr = round($bmr);

				$tmr = 0;
				switch ($activity) {
					case 1:
						$tmr = $bmr * 1.2;
						break;
					case 2:
						$tmr = $bmr * 1.4;
						break;
					case 3:
						$tmr = $bmr * 1.9;
						break;
				}
				$tmr -= 200;
				$tmr = round($tmr);

				$user_protein = 0;
				switch ($activity) {
					case 1:
						$user_protein = $weight * 1.2;
						break;
					case 2:
						$user_protein = $weight * 1.5;
						break;
					case 3:
						$user_protein = $weight * 2.0;
						break;
				}
				$user_protein = round($user_protein);
				
				$user_fat = 0;
				switch ($gender) {
					case "male":
						$user_fat = $weight * 0.6;
						break;
					case "female":
						$user_protein = $weight;
						break;
				}
				$user_fat = round($user_fat);

				$user_carbs = ($tmr - ($user_protein * 4 + $user_fat * 9)) / 4;
				$user_carbs = round($user_carbs);

				$query = "UPDATE users SET
				weight='$weight',
				height='$height',
				age='$age',
				gender='$gender',
				activity='$activity',
				bmr='$bmr',
				tmr='$tmr',
				user_carbs='$user_carbs',
				user_protein='$user_protein',
				user_fat='$user_fat',
				data_timestamp='$data_timestamp' WHERE email='".$_SESSION['login_user']."'";
				if ($conn->query($query) === TRUE) { ?>
					Congratulations, the data is complete! Based on your information, we have calculated the following daily intake values for you:<br>
					You should have <?php echo $tmr; ?> kcal per day.<br>
					You should have <?php echo $user_carbs; ?> grams of carbohydrates (carbs) per day.<br>
					You should have <?php echo $user_protein; ?> grams of protein per day.<br>
					You should have <?php echo $user_fat; ?> grams of fat per day.<br>
					Now it's time to make your first meal plan. Click <a href="plans.php">here</a> to continue.
				<?php }
				else {
					ChromePhp::log("error: ".$conn->error);
				}
			}
		} ?>

	</body>
</html>