<?php

	/*
	 * Shows the quiz completed page, with success percentage.
	 *
	 * Starts page in an existing session (already started from the 
	 * quiz_start page). Reads session variables.
	 */
	session_start();

	require_once("includes/constants.php");

	if (!isset($_SESSION["jsondata"]) || !isset($_POST["correct"])) {
		header("Location: " . Constants::REDIRECT_START);
		exit;
	}

	$count = $_SESSION["counter"];
	$correct_count = $_SESSION["correct"];

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
		<a href="<?php echo Constants::QUIZ_START; ?>">Home</a>
		<hr>
	</div>

	<div id="content">

		<?php

			if ($_POST["correct"] === "Correct") {
				// Increment the counter for the previous (the last) 
				// quiz data item answer evaluation.
				$correct_count++;
			}

			// Show the quiz result

			echo "<p>There were total <code>" . $count . "</code> quiz questions and you have answered <code>" . $correct_count . "</code> correctly.</p>";
			echo "<p>Your success % is <code>" . ($correct_count * 100) / $count . "</code> !</p>";

		?>

	</div>

	<div id="bottom-line"></div>

</body>
</html>
