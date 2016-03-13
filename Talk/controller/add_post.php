<?php
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
$dati_post = filter_input_array(INPUT_POST); //recupro i dati forniti dal'utente per mezzo della form presente in homepage.php
require_once '../model/file_manager.php';
if (insert_into($dati_post,"posts.csv"))
	print("Post salvato con successo");
else 
	print("Errore in fase di salvataggio");
//header("Refresh:2,../view/homepage.php");
?>