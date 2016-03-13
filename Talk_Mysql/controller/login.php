<?php 
$dati_login = filter_input_array(INPUT_POST); //recupro i dati forniti dal'utente per mezzo della form presente in index.php
require_once '../model/UserManager.php';
if(is_user_exists($dati_login['email'],$dati_login['password'])) {
	/*echo "Credenziali valide a breve sarà reindirizzato all' homepage.";
	header("Refresh:2,../view/homepage.php");*/
	//header("Location:../view/homepage.php");
	print("ok");
} else print("Dati di autenticazione non validi");
