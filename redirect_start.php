<?php

	/*
	 * Redirects to the quiz starter page.
	 */
	//session_start();
	//session_unset();
	//session_destroy();
	//("C:\php_includes\quiz_app_3");
	require_once("includes/constants.php");
	header("Location: " . Constants::QUIZ_START);
	exit;

?>