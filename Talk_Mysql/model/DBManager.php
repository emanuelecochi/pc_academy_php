<?php
/**
 * La funzione stabilisce una connessione con il db del sito,
 * in caso di errore si creerà una nuova riga all'interno del file di log,
 * all'interno del quale sarà riportata la natura dell'errore
 * @return mixed una connessione al db nel caso non si siano verificati problemi,
 * FALSE in caso di errore
 */
function connect() {
	$cn = mysqli_connect("localhost","DBUSER","", "DBNAME");
	// mysqli_errno restituisce il numero di eventuali errori nella connessione
	// mysqli_error restituisce la descrizione di eventuali errori nella connessione
	if(mysqli_errno($cn)) {
		file_put_contents("./log.csv", date(DATE_RFC822)."Errore(".mysqli_errno($cn)."):".mysqli_error($cn).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	} else return $cn;
}
?>