<?php 

class UpdateProfileFailed extends Exception {
	
	public function __construct($message,$code) {
		parent::__construct($message,$code, null);
	}
}

?>