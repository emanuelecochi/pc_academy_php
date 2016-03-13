<?php 
$dati_login = filter_input_array(INPUT_POST); //recupro i dati forniti dal'utente per mezzo della form presente in index.php
require_once '../model/file_manager.php';
$dati_autenticazione = select_all();
foreach ($dati_autenticazione as $utente_corrente) {
	if(($utente_corrente['username']==$dati_login['username'])
		|| ($utente_corrente['nickname']==$dati_login['username'])
		&& ($utente_corrente['password']==$dati_login['password'])) {
			session_start();
			$_SESSION['nickname'] = $utente_corrente['nickname'];
			header("Location:../view/homepage.php");
		}
}
require_once '../shared/header.php';
?>
<script>
	$(document).ready(function(){
		alert("Dati autenticazione non validi");
		window.location='../index.php';
	});
</script>