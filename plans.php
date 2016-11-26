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

		<!-- Table with header date --> 
		<p><table class="tg">
		  <tr>
		    <th class="tg-yw4l">Meal type</th>
		    <th class="tg-baqh" colspan="6">DATE</th>
		  </tr>
		</table></p>

		<!-- Table with meal information -->
		<p><table class="tg">
		  <tr>
		    <th class="tg-baqh" rowspan="7">MEAL TYPE</th>
		    <th class="tg-yw4l">MEAL NAME</th>
		    <th class="tg-yw4l">Energy (kcal)</th>
		    <th class="tg-yw4l">Carbs (g)</th>
		    <th class="tg-yw4l">Protein (g)</th>
		    <th class="tg-yw4l">Fat (g)</th>
		    <th class="tg-yw4l">Quantity (g)</th>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-yw4l">INGREDIENT</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		  <tr>
		    <td class="tg-lqy6" colspan="2">Totals</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		    <td class="tg-yw4l">VALUE</td>
		  </tr>
		</table></p>

		<!-- Table with daily totals -->
		<p><table class="tg">
		  <tr>
		    <th class="tg-lqy6" colspan="2">Totals</th>
		    <th class="tg-yw4l">VALUE</th>
		    <th class="tg-yw4l">VALUE</th>
		    <th class="tg-yw4l">VALUE</th>
		    <th class="tg-yw4l">VALUE</th>
		    <th class="tg-yw4l">VALUE</th>
		  </tr>
		</table></p>

	</body>
</html>