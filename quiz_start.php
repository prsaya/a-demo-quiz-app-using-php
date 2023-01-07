<?php

	/*
	 * Shows the quiz app's starter page with instructions.
	 * Builds the quiz data array from the Json file. In case
	 * the data is present from the previous session, it is 
	 * used (instead of reading from file).
	 *
	 * In case of an error processing the Json file or data,
	 * shows appropriate message and exits the app.
	 *
	 * Starts the app in a session. Sets session variables: quiz 
	 * items array, current item counter and answered correct count.
	 */
	session_start();

	$_SESSION["counter"] = 0;
	$_SESSION["correct"] = 0;

	require_once "includes/file_util.php";
	$json_data = (isset($_SESSION["jsondata"])) ? $_SESSION["jsondata"] 
												: FileUtil::getJsonData();
	shuffle($json_data);
	$_SESSION["jsondata"] = $json_data;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz App</title>
	<link rel="stylesheet" href="public/quiz_app_styles.css">
</head>

<body>

	<div class="top">
		<h1>Quiz App</h1>
		<hr>
	</div>

	<div id="content">

		<?php

			echo "<h2>Welcome to the quiz!</h2>";
			echo "<ul>";
			echo "<li>There are <code>" . count($json_data) . "</code> quiz questions.</li>";
			echo "<li>The quiz is not timed.</li>";
			echo "<li>You will require a JavaScript enabled browser to play this.</li>";
			echo "<li>At the end you will get to see your score.</li>";
			echo "<li>Please don't use previous and next browser buttons during quiz.</li>";
			echo "</ul>";
			echo "<br>";

		?>

		<form method="post" action="<?php echo Constants::QUIZ_FORM; ?>" style="text-align: center;">
			<input type="submit" value="Start" class="buttons" />
			<input type="hidden" name="correct" value="" />
		</form>

	</div>

	<div id="bottom-line"></div>

</body>
</html>
