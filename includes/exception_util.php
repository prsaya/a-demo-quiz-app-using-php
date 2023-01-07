<?php

	/*
	 * Utility class with a static method to handles file or data exceptions.
	 * Note the app exits after the exception detail is displayed in the page.
	 */
	class ExceptionUtil {

		public static function handle($err_str, $ex) {

			switch($err_str) {
				case "JSON_FILE_ERROR":
					// This exception in case of file realted errors.
					// E.g., the file is not found.
					$err_descr = "There was an error while accessing or reading the file. Verify the file and try again: ";
					break;
				case "JSON_DATA_ERROR":
					// This is a case of Json data parsing errors.
					// E.g., Json syntax error like missing quotes for a key.
					$err_descr = "There was an error while parsing Json data. Verify the file contents and try again: ";
					break;
				case "JSON_DATA_EMPTY":
					// The Json file has no data
					$err_descr = "The Json file has no data to process: ";
					break;
				default: 
					$err_descr = "Unknown error!";
			}

			echo "<h2>" . $err_str . "</h2>";
			echo "<p>" . $err_descr . "<code>" . Constants::JSON_DATA_FILE . "</code></p>";
			echo "<p>Exiting the app.</p>";

			if ($ex) {
				print_r($ex);
			}

			exit(1);
		}
	}

?>