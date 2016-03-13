<?php 
require_once '../model/Talk_Config.php';
$dati_login = filter_input_array(INPUT_POST);
if(Talk_Config::_ADMINUSER==$dati_login['username'] && Talk_Config::_ADMINPASS==$dati_login['password']) {
	// le credenziali fornite coincidono con quelle di un amministratore
	session_star();
	$_SESSION['admin_logged'] = 1;
} else {
	require_once '../model/UserManager.php';
	$usermaneger = new UserManager;
	try {
		$usermaneger->is_user_exists($dati_login['username'], $dati_login['password']);
		session_start();
		$_SESSION['username']=$dati_login['username'];
		print "ok";
	} catch (LoginException $ex) {
		print $ex->getMessage();
	}
}
?>