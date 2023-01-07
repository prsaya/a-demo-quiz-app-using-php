<?php

	require_once "constants.php";
	require_once "exception_util.php";

	/*
	 * Utility class with a static method to read the input Json 
	 * data file and decode the contents as an array.
	 * Returns the array to be used in the app.
	 *
	 * Calls an exception handler in case of file or data errors.
	 */
	class FileUtil {


		public static function getJsonData() {

			// Read file and get data as a string.
			$json_str = @file_get_contents(Constants::JSON_DATA_FILE);

			if (!$json_str) {
				ExceptionUtil::handle("JSON_FILE_ERROR", null);
			}

			// String conversion required for processing strings with 
			// characters like, ö (o with umlauts).
			$json_str = iconv("ISO-8859-1", "UTF-8", $json_str);

			try {
				// Decode string to Json array.
				$json_data = json_decode($json_str, true, 10, JSON_THROW_ON_ERROR);
			}
			catch(JsonException $ex) {
				ExceptionUtil::handle("JSON_DATA_ERROR", $ex);
			}

			if (count($json_data) === 0) {
				ExceptionUtil::handle("JSON_DATA_EMPTY", null);
			}

			return $json_data;
		}
	}

?>
