/*
 * JavaScript function invoked with the button click to evaluate
 * the user chosen answers. Displays if the answer was correct or 
 * not, or warns if no answer was chosen. 
 *
 * Styles the buttons based upon the user actions.
 * For the last quiz data item, changes the button and the
 * action values (for showing the result page).
 */
function evaluate_input() {

	// Evaluate and show response to user input

	const opts = document.getElementsByClassName("opts");
	const answered = [...opts].filter(e => e.checked).map(e => e.value);
	const ans = document.getElementById("answer_text");

	if (answered.length === 0) {
		ans.style.color = "var(--highlight)";
		ans.innerHTML = "Must select at least one answer option!";
		return;
	}

	ans.style.color = "var(--dark)";
	const answers = <?php echo json_encode($item["answers"]); ?>;

	if (answered.length === answers.length &&
			answers.every(e => answered.includes(e))) {
		ans.innerHTML = "<p>Correct answer.</p>";
		document.getElementById("correct").value = "Correct";
	}
	else {
		ans.innerHTML = "<p>Incorrect answer.</p>";
		document.getElementById("correct").value = "Incorrect";
	}

	const notes = <?php echo json_encode($item["notes"]); ?>;
	ans.innerHTML += notes.join("<br>");

	// Last quiz question

	const last = <?php echo json_encode(isset($is_last_question)); ?>;

	if (last) {
		document.getElementById("quiz-form").action = 
			<?php echo json_encode(Constants::QUIZ_RESULT); ?>;
		document.getElementById("next").value = "Result";
	}

	// Button styling

	document.getElementById("next").disabled = false;
	document.getElementById("answer").disabled = true;
}