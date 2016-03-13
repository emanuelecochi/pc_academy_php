<?php
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php"); //l'utente non si era lggato quindi viene reindirizzato alla pagina per gestire il login o la registrazione
$dati_post = filter_input_array(INPUT_POST);
require_once '../model/PostsManager.php';
if(save_post($dati_post))
	print("Post salvato con successo");
	//echo $_SESSION['nickname'].$dati_post['titolo'].$dati_post['categoria'].$dati_post['contenuto'];
else print ("error");
?>