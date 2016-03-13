<?php 
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../../model/PostsManager.php';
$dati_form = $_REQUEST['id_post'];
//var_dump($dati_form);
//echo $dati_form;
switch ($dati_form) {
	case "all": if(($num = delete_all_my_posts($_SESSION['nickname']))!==FALSE)
					print "Sono stati cancellati $num post";
				else print "Errore in fase di cancellazione";
				break;
		default: $result = FALSE; 
				 if(!is_array($dati_form)) {
				 	$result = delete_post(array($dati_form));
				 } else $result = delete_post($dati_form);
				 print $result !==FALSE?"Cancellazione completata con successo":"Errore in fase di cancellazione";
}
header("Refresh:3,../index.php");
?>