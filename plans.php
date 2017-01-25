<?php

	session_start();
	include 'chromePhp.php';
	require ('connection.php');

	if (!isset($_SESSION['login_user'])) {
		header("location: login.php");
	}


?>
<html>
	<head><title>Your Meal Plans</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

		<style type="text/css">
			.tg  {border-collapse:collapse;border-spacing:0;width:900px;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg .tg-baqh{text-align:center;vertical-align:top}
			.tg .tg-lqy6{text-align:right;vertical-align:top}
			.tg .tg-yw4l{vertical-align:top}
		</style>

<?php require ('rason_connection.php'); ?>

	</head>
	<body>
		<?php if (!isset($_POST['calculate'])) { ?>
			<form method="post" action="plans.php">
				<input type="submit" name="calculate" value="Make a meal plan for me">
			</form>
		<?php }
		else {

			$breakfast_id = rand(1, 3);
			$snack_id = rand(1, 14);
			$dinner_id = rand(1, 7);

			$breakfast_query = "SELECT * FROM breakfasts WHERE ID = '$breakfast_id'"; 
			$breakfast_result = $conn->query($breakfast_query);
			$snack_query = "SELECT * FROM snacks WHERE ID = '$snack_id'"; 
			$snack_result = $conn->query($snack_query);
			$dinner_query = "SELECT * FROM dinners WHERE ID = '$dinner_id'";
			$dinner_result = $conn->query($dinner_query);

			$breakfast = mysqli_fetch_array($breakfast_result, MYSQLI_ASSOC);
			$snack = mysqli_fetch_array($snack_result, MYSQLI_ASSOC);
			$dinner = mysqli_fetch_array($dinner_result, MYSQLI_ASSOC);
			$breakfast_portion = 1;
			$snack_portion = 1;
			$dinner_portion = 1;

			$goal = "";
			$kcal_plan = "";
			$carbs_plan = "";
			$protein_plan = "";
			$fat_plan = "";

			$check_query = "SELECT * FROM users WHERE email='".$_SESSION['login_user']."'";
			$login_check = $conn->query($check_query);
			$row_count = $login_check->num_rows;

			if ($row_count != 1) {
				echo "<p>Error! Contact administrator!</p>";
			}
			else {
				$user_data = mysqli_fetch_assoc($login_check);
				$kcal_user = $user_data['tmr'];
				$carbs_user = $user_data['user_carbs'];
				$protein_user = $user_data['user_protein'];
				$fat_user = $user_data['user_fat'];
			}

			$kcal = 0;
			$carbs = 0;
			$protein = 0;
			$fat = 0;

				?>
				<p><table class="tg">
					<tr>
					    <th class="tg-baqh" rowspan="7">Breakfast</th>
					    <th class="tg-yw4l"><?php echo $breakfast['name']; ?></th>
					    <th class="tg-yw4l">Energy (kcal)</th>
					    <th class="tg-yw4l">Carbs (g)</th>
					    <th class="tg-yw4l">Protein (g)</th>
					    <th class="tg-yw4l">Fat (g)</th>
					    <th class="tg-yw4l">Quantity (g)</th>
					</tr>
				<?php
					for ($i = 1; $i <= 6; $i++) {
					  	$db_key = 'ingredient_'.$i;
					  	$ingredient = $breakfast[$db_key];
					  	if ($ingredient !== null) {
					  		$ingredient_query = "SELECT * FROM articles WHERE name = '$ingredient'"; 
							$ingredient_result = $conn->query($ingredient_query);
							$ingredient_data = mysqli_fetch_array($ingredient_result, MYSQLI_ASSOC);
							$db_key = 'constraint_'.$i;
							$portion = $breakfast[$db_key] * $breakfast_portion;
						  
							/* Building JSON */

							$kcal_plan .= $ingredient_data['kcal']." * ".$breakfast[$db_key]." * x[1] + ";
							$carbs_plan .= $ingredient_data['carbs']." * ".$breakfast[$db_key]." * x[1] + ";
							$protein_plan .= $ingredient_data['protein']." * ".$breakfast[$db_key]." * x[1] + ";
							$fat_plan .= $ingredient_data['fat']." * ".$breakfast[$db_key]." * x[1] + ";

							/* /Building JSON */

							$kcal += $ingredient_data['kcal'] * $portion;
							$carbs += $ingredient_data['carbs'] * $portion;
							$protein += $ingredient_data['protein'] * $portion;
							$fat += $ingredient_data['fat'] * $portion;
						  	?>
							<tr>
							    <td class="tg-yw4l"><?php echo $ingredient_data['name']; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['kcal'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['carbs'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['protein'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['fat'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $portion * 100; echo " g"; ?></td>
							</tr> <?php
						}
				  	} ?>
				</table></p>

				<p><table class="tg">
					<tr>
					    <th class="tg-baqh" rowspan="7">Snack</th>
					    <th class="tg-yw4l"><?php echo $snack['name']; ?></th>
					    <th class="tg-yw4l">Energy (kcal)</th>
					    <th class="tg-yw4l">Carbs (g)</th>
					    <th class="tg-yw4l">Protein (g)</th>
					    <th class="tg-yw4l">Fat (g)</th>
					    <th class="tg-yw4l">Quantity (g)</th>
					</tr>

				<?php
					for ($i = 1; $i <= 6; $i++) {
					  	$db_key = 'ingredient_'.$i;
					  	$ingredient = $snack[$db_key];
					  	if ($ingredient !== null) {
					  		$ingredient_query = "SELECT * FROM articles WHERE name = '$ingredient'"; 
							$ingredient_result = $conn->query($ingredient_query);
							$ingredient_data = mysqli_fetch_array($ingredient_result, MYSQLI_ASSOC);
							$db_key = 'constraint_'.$i;
							$portion = $snack[$db_key] * $snack_portion;
						  
							/* Building JSON */

							$kcal_plan .= $ingredient_data['kcal']." * ".$snack[$db_key]." * x[2] + ";
							$carbs_plan .= $ingredient_data['carbs']." * ".$snack[$db_key]." * x[2] + ";
							$protein_plan .= $ingredient_data['protein']." * ".$snack[$db_key]." * x[2] + ";
							$fat_plan .= $ingredient_data['fat']." * ".$snack[$db_key]." * x[2] + ";

							/* /Building JSON */

							$kcal += $ingredient_data['kcal'] * $portion;
							$carbs += $ingredient_data['carbs'] * $portion;
							$protein += $ingredient_data['protein'] * $portion;
							$fat += $ingredient_data['fat'] * $portion;
						  	?>
							<tr>
							    <td class="tg-yw4l"><?php echo $ingredient_data['name']; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['kcal'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['carbs'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['protein'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['fat'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $portion * 100; echo " g"; ?></td>
							</tr> <?php
						}
					} ?>
				</table></p>

				<p><table class="tg">
				  <tr>
				    <th class="tg-baqh" rowspan="7">Dinner</th>
				    <th class="tg-yw4l"><?php echo $dinner['name']; ?></th>
				    <th class="tg-yw4l">Energy (kcal)</th>
				    <th class="tg-yw4l">Carbs (g)</th>
				    <th class="tg-yw4l">Protein (g)</th>
				    <th class="tg-yw4l">Fat (g)</th>
				    <th class="tg-yw4l">Quantity (g)</th>
				  </tr>
				<?php
					for ($i = 1; $i <= 6; $i++) {
					  	$db_key = 'ingredient_'.$i;
					  	$ingredient = $dinner[$db_key];
					  	if ($ingredient !== null) {
					  		$ingredient_query = "SELECT * FROM articles WHERE name = '$ingredient'"; 
							$ingredient_result = $conn->query($ingredient_query);
							$ingredient_data = mysqli_fetch_array($ingredient_result, MYSQLI_ASSOC);
							$db_key = 'constraint_'.$i;
							$portion = /* $dinner[$db_key] * */$dinner_portion; 

							/* Building JSON */

							$kcal_plan .= $ingredient_data['kcal']." * ".$dinner[$db_key]." * x[3] + ";
							$carbs_plan .= $ingredient_data['carbs']." * ".$dinner[$db_key]." * x[3] + ";
							$protein_plan .= $ingredient_data['protein']." * ".$dinner[$db_key]." * x[3] + ";
							$fat_plan .= $ingredient_data['fat']." * ".$dinner[$db_key]." * x[3] + ";

							/* /Building JSON */

							$kcal += $ingredient_data['kcal'] * $portion;
							$carbs += $ingredient_data['carbs'] * $portion;
							$protein += $ingredient_data['protein'] * $portion;
							$fat += $ingredient_data['fat'] * $portion;
						  	?>
							<tr>
							    <td class="tg-yw4l"><?php echo $ingredient_data['name']; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['kcal'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['carbs'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['protein'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $ingredient_data['fat'] * $portion; ?></td>
							    <td class="tg-yw4l"><?php echo $portion * 100; echo " g"; ?></td>
							</tr> <?php
						}
					} ?>					
				  </table></p>

				  <p><table class="tg">
				  <tr>
				    <th class="tg-lqy6" colspan="2">Totals</th>
				    <th class="tg-yw4l"><?php echo $kcal; ?></th>
				    <th class="tg-yw4l"><?php echo $carbs; ?></th>
				    <th class="tg-yw4l"><?php echo $protein; ?></th>
				    <th class="tg-yw4l"><?php echo $fat; ?></th>
				  </tr>
				  </table></p>
			<?php 
			$kcal_plan = substr($kcal_plan, 0, -3);
			$carbs_plan = substr($carbs_plan, 0, -3);
			$protein_plan = substr($protein_plan, 0, -3);
			$fat_plan = substr($fat_plan, 0, -3);
			$goal = "("
				.$kcal_plan." - ".$kcal_user.") * (".$kcal_plan." - ".$kcal_user.") + ("
				.$carbs_plan." - ".$carbs_user.") * (".$carbs_plan." - ".$carbs_user.") + ("
				.$protein_plan." - ".$protein_user.") * (".$protein_plan." - ".$protein_user.") + ("
				.$fat_plan." - ".$fat_user.") * (".$fat_plan." - ".$fat_user.")";

			/* Sending JSON */
			$data_string = json_encode(
				array("variables" =>
					array("x" =>
						array("lower" =>
							array(0, 0, 0),
							"finalValue" => array())),
						"objective" =>
							array("obj" =>
								array("type" => "maximize",
									"formula" => $goal,
									"finalValue" => array()))));
			echo $data_string;
         
			$ch = curl_init('https://rason.net/api/optimize');                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    'Content-Type: application/json',                                                                                
			    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoidXNlciIsInRpbWUiOiI2MCIsIm1vbnRoIjoiMTQ0MDAiLCJ2YXJpYWJsZXMiOiIyMDAiLCJsaW5lYXJfdmFycyI6IjIwMCIsIm5vbmxpbmVhcl92YXJzIjoiMTAwIiwidW5jZXJ0YWluX3ZhcnMiOiIyNCIsInVuY2VydGFpbl9mY25zIjoiMTIiLCJmdW5jdGlvbnMiOiIxMDAiLCJpbnRlZ2VycyI6IjIwMCIsImVuZ2luZXMiOiIwMDAwMDAwIiwibWF4VHJpYWxzIjoiMTAwMCIsInVzZXJpZCI6IjAiLCJ1c2VybmFtZSI6Im1hY2llai5qYWxvd2llY0BnbWFpbC5jb20iLCJwbGFuIjoiTm9uZSIsImlhdCI6IjE0ODE3MzA3MDEuODA0NTkiLCJqdGkiOiIwYzhlZWQ3ZTc4YTBjY2YwMmY0MTAwYjQzYzNkMjJkMCJ9.2z4OTgP2rO76GOco2YvWtnLswOMtxYWqtRi7vUeBPpc'                                                                    
			));              
                                                                                                   			                                                                                                                     
			$result = curl_exec($ch);
			$result_php = json_decode($result);
			if (!$result) {
				echo "dupa";
			}

		}
			?>

<input type="button" value="Optimize" onclick="rasonApp.startSolve();" />


	
	</body>
</html>