<?php 
class LoginException extends Exception {
	
	function __construct($message, $code) {
		parent::__construct($message, $code, $previous=null); // override del costruttore della classe Exception
	}
}
?>