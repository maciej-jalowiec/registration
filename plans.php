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

		<style type="text/css">
			.tg  {border-collapse:collapse;border-spacing:0;width:900px;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
			.tg .tg-baqh{text-align:center;vertical-align:top}
			.tg .tg-lqy6{text-align:right;vertical-align:top}
			.tg .tg-yw4l{vertical-align:top}
		</style>

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
			$kcal_json = "";
			$carbs_json = "";
			$protein_json = "";
			$fat_json = "";

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

							$kcal_json .= $ingredient_data['kcal']." * ".$breakfast[$db_key]." * x[1] + ";
							$carbs_json .= $ingredient_data['carbs']." * ".$breakfast[$db_key]." * x[1] + ";
							$protein_json .= $ingredient_data['protein']." * ".$breakfast[$db_key]." * x[1] + ";
							$fat_json .= $ingredient_data['fat']." * ".$breakfast[$db_key]." * x[1] + ";

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

							$kcal_json .= $ingredient_data['kcal']." * ".$snack[$db_key]." * x[2] + ";
							$carbs_json .= $ingredient_data['carbs']." * ".$snack[$db_key]." * x[2] + ";
							$protein_json .= $ingredient_data['protein']." * ".$snack[$db_key]." * x[2] + ";
							$fat_json .= $ingredient_data['fat']." * ".$snack[$db_key]." * x[2] + ";

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

							$kcal_json .= $ingredient_data['kcal']." * ".$dinner[$db_key]." * x[3] + ";
							$carbs_json .= $ingredient_data['carbs']." * ".$dinner[$db_key]." * x[3] + ";
							$protein_json .= $ingredient_data['protein']." * ".$dinner[$db_key]." * x[3] + ";
							$fat_json .= $ingredient_data['fat']." * ".$dinner[$db_key]." * x[3] + ";

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
			$goal = $kcal_json.$carbs_json.$protein_json.$fat_json;
			$goal = substr($goal, 0, -2);

			/* Sending JSON */
			$url = 'https://rason.net/api/optimize';
			$ch = curl_init($url);

			class Emp {
				public $variables = "";
				public $constraints  = "";
				public $objective = "";
			}

			$e = new Emp();
			$e->variables = '{x: { lower: [0, 0, 0], finalValue: [] }}';
			$e->constraints = '';
			$e->objective = '{obj: { type: "maximize", formula:'.$goal.', finalValue: [] }}';
			$jsonDataEncoded = json_encode($e);

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
			$result = curl_exec($ch);

			$received_json = file_get_contents('https://rason.net/api/optimize');
			echo $received_json;
			$new_json = json_decode($received_json);

		}
			?>


	
	</body>
</html>