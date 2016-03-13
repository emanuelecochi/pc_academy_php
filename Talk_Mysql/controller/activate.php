<?php 
$email = filter_input(INPUT_GET,'username'); // recupero la mail  dell'utente che si è appena registrato
require_once '../model/UserManager.php';
if(activate_new_user($email))
	echo "Attivazione completata con successo sei utente del nostro sito";
else echo "Si è verificato un problema durante la fase di registrazione contatta l'amministratore";
?>