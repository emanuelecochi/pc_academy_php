<?php
/**
 * Funzione deputata al salvataggio dei dati all'interno di un file 
 * se non indicato esplicitamente, l'operazione di scrittura riguarderà
 * il file utenti.csv tale valore è assegnato come valore di default 
 * al parametro nome_file, ciò singifica che sarà possbile invocare la funzione
 * in due modi
 * <ul>
 * <li>insert_into($dati);</li>
 * <li>insert_into($dati,$nome_di_un_file)</li>
 * </ul>
 * La modalità di scrittura prescelta è quella append
 * @example insert_into($dati_form); Salvo i dati in utenti.csv
 * @example insert_into($dati_form,"posts.csv"); Salvo i dati in posts.csv
 * @param String $dati informazioni da salvare
 * @param String $nome_file nome del file in sui memorizzare i valori forniti 
 * tramite il parametro $dati_form
 * @return mixed Il nickname del nuovo utente, FALSE in caso di errore
 *  */
function insert_into($dati,$nome_file="utenti.csv") {
    $fp = fopen($nome_file, "a"); // apro il file in modalità append preservo quindi i vecchi dati
    flock($fp, LOCK_EX); // acquisco l'uso esclusivo del file per l'operazione in corso
    $result = fputcsv($fp, $dati, $nome_file=="./utenti.csv"?";":"#");
    fclose($fp);
    if($result!==FALSE) {
        switch ($nome_file) {
            case "utenti.csv": return $dati['nickname'];
            case "posts.csv": return TRUE;    
        }
    } else return FALSE;
}

function select_all($nome_file="./utenti.csv") {
	switch ($nome_file) {
		case "./utenti.csv": $struttura_riga = array("username","nickname","password","avatar");
							 break;
		default: $struttura_riga = array("titolo","categoria","contenuto");
				 break;
	}
	$dati = file($nome_file); //genero un vettore in cui ogni riga del file sorgente � memorizzata in una cella del vettore
	$utenti = array();
	$posts = array();
	switch ($nome_file) {
		case "./utenti.csv" : foreach ($dati as $riga_corrente) {
								$utenti[] = array_combine($struttura_riga, explode(";",$riga_corrente));
						      }		
							  return $utenti;
							  break;
							  
	    case "../controller/posts.csv" : foreach ($dati as $riga_corrente) {
								$posts[] = array_combine($struttura_riga, explode("#",$riga_corrente));
						      }	
							  return $posts;
							  break;
	}
	
}

