<?php 
$registration_data = filter_input_array(INPUT_POST);
require_once '../model/UserManager.php';
$usm = new UserManager;
try {
	$usm->registerUser($registration_data);
	if (isset ( $_FILES ['avatar'] )) {
		// 0777 privilegi di lettura e scrittura e di esecuzione sulla directory creata (utenti, proprietario e gruppi proprietario)
		mkdir ( "../images/" . $registration_data ['username'] . "/");
		move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], "../images/" . $registration_data ['username'] . "/" . $_FILES ['avatar'] ['name'] );
		// salvo in registration_data il nome del file
		$registration_data ['avatar'] = $registration_data ['username'] . "/" . $_FILES ['avatar'] ['name'];
	} else
		$registration_data ['avatar'] = $registration_data ['username'] . "/user.png";
	
	$message = "<html><body>Congratulation your registration is compleate. Activate using link below 
	<a href='www.yoursiteexample.org/pc_academy/Talk_Mysql_OOP/controller/activate.php?username={$registration_data['username']}'>Activate</a></body></html>";
	mail ( $registration_data ['username'], "Welcome on Talk", $message, "MIME-Version: 1.0 \r\n" . "Content-type: text/html; charset=iso-8859-1 \r\n" . "From: Administator Talk <yourmailexample@domain.com>" ); // header email
} catch (RegistrationFailed $ex) {
	echo $ex->getCode(),$ex->getMessage();
}

?>