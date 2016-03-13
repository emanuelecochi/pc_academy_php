<?php 
class Logger {
	public static function save_log($error_message,$error_code="n/a") {
		file_put_contents("log.csv", "Errore n°$error_code - data - ".date(DATE_RFC822)." message:$error_message".PHP_EOL, FILE_APPEND|LOCK_EX);
	}
}
?>