<?php 

class ActivationFailed extends Exception {
	
	public function __construct($message,$code) {
		parent::__construct($message,$code, null);
	}
}

?>