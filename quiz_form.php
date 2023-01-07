<?php

	/*
	 * Shows a quiz data item for answer selection.
	 *
	 * Starts page in an existing session (already started from the 
	 * quiz_start page). Reads and updates session variables.
	 *
	 * Calls a JavaScript function when Answer button is clicked. This
	 * evaluates the user input and shows if the selected options were 
	 * correct.
	 */
	session_start();

	//set_include_path("C:\php_includes\quiz_app_3");
	require_once("includes/constants.php");

	if (!isset($_SESSION["jsondata"]) || !isset($_POST["correct"])) {
		header("Location: " . Constants::REDIRECT_START);
		exit;
	}

	$json_data = $_SESSION["jsondata"];
	$counter = $_SESSION["counter"];
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
		
		<a href="<?php echo Constants::REDIRECT_START; ?>">Home</a>
		<hr>

		<form id="quiz-form" method="post">
			<input id="correct" type="hidden" name="correct" />
			<input id="answer" class="buttons" type="button" value="Answer" onclick="evaluate_input()" />
			<input id="next" class="buttons" type="submit" value="Next" disabled/>
		</form>

	</div>

	<div style="clear: right;"></div>

	<div id="content">

		<?php

			if ($_POST["correct"] === "Correct") {
				// Increment the counter for the previous
				// quiz data item answer evaluation
				$correct_count++;
			}

			$item = $json_data[$counter];
			
			// Render the quiz data item

			echo "<p>" . ++$counter . ". " . $item["question"] . "</p>";

			foreach($item["options"] as $opt) {
				$opt_no = substr($opt, 1, 1);
				$opt_type = ($item["type"] === "S") ? "radio" : "checkbox";
				echo "<input type=" . $opt_type . " class='opts' name='opts' value=$opt_no> $opt <br>";
			}

			if (count($json_data) === $counter) {
				echo "<p style='color: var(--highlight);'>This is the last Question!</p>";
				$is_last_question = true;
			}

			$_SESSION["counter"] = $counter;
			$_SESSION["correct"] = $correct_count;

		?>

		<p id="answer_text"></p>

	</div>

	<div id="bottom-line"></div>

	<script type="text/javascript">
		/* evaluate_input JS function definition */
		<?php require("public/quiz_app.js"); ?>
	</script>

</body>
</html>