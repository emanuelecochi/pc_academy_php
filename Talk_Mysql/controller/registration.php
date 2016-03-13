<?php
$registration_data = filter_input_array ( INPUT_POST );
require_once '../model/UserManager.php';
if (test_user( $registration_data ['email'], $registration_data ['nickname'], $registration_data ['password'] )) {
	echo "I dati forniti per la registrazione non sono validi";
	header ( "Refresh:3,./index.php" );
} else {
	if (isset ( $_FILES ['avatar'] )) {
		// 0777 privilegi di lettura e scrittura e di esecuzione sulla directory creata (utenti, proprietario e gruppi proprietario)
		mkdir ( "../images/" . $registration_data ['email'] . "/", 0777 );
		move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], "../images/" . $registration_data ['email'] . "/" . $_FILES ['avatar'] ['name'] );
		// salvo in registration_data il nome del file
		$registration_data ['avatar'] = $registration_data ['email'] . "/" . $_FILES ['avatar'] ['name'];
	} else
		$registration_data ['avatar'] = $registration_data ['email'] . "user.png";
	if (save_user ( $registration_data )) {
		$message = "<html><body>Congratulation your registration is compleate. Activate using link below 
	<a href='www.yoursiteexample.org/pc_academy/Talk_Mysql/controller/activate.php?username={$registration_data['email']}'>Activate</a></body></html>";
		mail ( $registration_data ['email'], "Welcome on Talk", $message, "MIME-Version: 1.0 \r\n" . "Content-type: text/html; charset=iso-8859-1 \r\n" . "From: Administator Talk <yourmailexample@domain.com>" ); // header email
		echo "Registrazione completa con successo.<br/> Ti è stata appena inviata una mail con cui portai attivare il tuo account e accedere così ai servizi del nostro sito";
	} else
		echo "Si è verificato un problema in fase di registrazione, riprova più tardi";
}
?>