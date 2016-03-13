<?php
$dati_form = filter_input_array(INPUT_POST);
if(isset($_FILES['avatar'])) {
    $dati_avatar= $_FILES['avatar']; 
    $nome_file = $dati_avatar['name']; // estraggo il nome originale del file immagine
    $info = explode(".", $nome_file); // converto il nome del file in un vettore adottando come carattere
                                      // di separazione il simbolo . questa divisione mi consentirà di 
                                      // estrarre l'estensione del file anche nel caso in cui ci fossero
                                      //  più di un punto
    $estensione_file = $info[count($info)-1]; // estraggo l'estensione del file questa occuperà sicuramente
                                              // l'ultima posizione all'interno del vettore
    $nome_file_avatar = $dati_form['email'].".".$estensione_file; // il nome del file che contiene 
                                                                  // l'immagine dell'avatar è costruito 
                                                                  // concatenendo l'indirizzo email e 
                                                                  // l'estennsione del file immagine ottenuta
                                                                  // nell'istruzione precedente
    move_uploaded_file($dati_avatar['tmp_name'], "images/".$nome_file_avatar);
    $dati_form['avatar']=$nome_file_avatar;
} else {
    $dati_form['avatar']="default.png";
}
require_once '../model/file_manager.php';
$esito = insert_into($dati_form);
session_start();
$_SESSION['nickname']=$esito;
echo "Registrazione completata con successo. A breve sarai reindirizzato alla homepage";
header("Refresh:3,../view/homepage.php");

