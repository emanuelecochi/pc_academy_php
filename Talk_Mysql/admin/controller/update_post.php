<?php 
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../../model/PostsManager.php';
$id_post = $_REQUEST['id_post'];
$dati_form = filter_input_array(INPUT_POST);
if(update_post($dati_form,$id_post))
	echo "Post aggiornato con successo";
else 
	echo "Errore nell'aggiornamento del post";
?>