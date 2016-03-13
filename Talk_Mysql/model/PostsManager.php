<?php 
define("SAVE_POST","INSERT INTO talk_posts (id_autore,titolo,testo_post,categoria) VALUES(?,?,?,?)");
define("DELETE_POST", "DELETE FROM talk_posts WHERE id_post=?");
define("DELETE_ALL_MY_POST", "DELETE FROM talk_posts WHERE id_autore=?");
define("SELECT_MY_POSTS","SELECT * FROM talk_posts WHERE id_autore=?");
define("SELECT_MY_POST","SELECT * FROM talk_posts WHERE id_autore=? AND id_post=?");
define("UPDATE_POST", "UPDATE talk_posts SET titolo = ?, testo_post = ?, categoria = ? WHERE id_post = ?");
require_once 'DBManager.php';
$link = connect();
/**
 * 
 * @param $dati_post si tratta di un vettore all'interno del quale ci sono tutti i dati relativi al post
 *  che si sta per salvare all'interno della tabella talk_posts
 */
function save_post($dati_post) {
	global $link;
	$stmt = mysqli_prepare($link, SAVE_POST);
	mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['nickname'],htmlentities($dati_post['titolo']),
			htmlentities($dati_post['contenuto']),$dati_post['categoria']); // tolto i filter_var su contenuto perchè lo rendeva vuoto
	mysqli_stmt_execute($stmt);
	if(mysqli_stmt_affected_rows($stmt)>0) // aggiunto >0 perchè in caso di errore da -1 ossia true quindi veniva stampato post salvato e non veniva salvato l'errore nei log
		return TRUE;
	else if(mysqli_errno($link)) { // loggo gli errori legati al dbms principalmente connessi alla connessioene
		file_put_contents("./log.csv", date(DATE_RFC822)."Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	} else return FALSE;
}

function get_all_posts($username) {
	global $link;
	$stmt = mysqli_prepare($link, SELECT_MY_POSTS);
	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);
	//mysqli_stmt_store_result($stmt); //aggiunto! altrimenti num_rows era sempre 0
	//echo mysqli_stmt_num_rows($stmt);
	if(mysqli_errno($link)) { // loggo gli errori legati al dbms principalmente connessi alla connessioene
		file_put_contents("./log.csv", date(DATE_RFC822)."Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	else return $stmt;
}

function get_my_post($username,$id_post) {
	global $link;
	$stmt = mysqli_prepare($link, SELECT_MY_POST);
	mysqli_stmt_bind_param($stmt,"si",$username,$id_post);
	mysqli_stmt_execute($stmt);
	//mysqli_stmt_store_result($stmt); //aggiunto! altrimenti num_rows era sempre 0
	//echo mysqli_stmt_num_rows($stmt);
	if(mysqli_errno($link)) { // loggo gli errori legati al dbms principalmente connessi alla connessioene
		file_put_contents("./log.csv", date(DATE_RFC822)."Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	else return $stmt;
}

function delete_all_my_posts($username) {
	global $link;
	mysqli_autocommit($link, false); // disabilito l'auto-commit
	//mysqli_begin_transaction(); // inizia la transazione
	$stmt = mysqli_prepare($link, DELETE_ALL_MY_POST);
	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);
	//mysqli_stmt_store_result($stmt);
	if(mysqli_errno($link)) {
		mysqli_rollback($link); // ripristino la configurazione della tabella talk_posts all'istante immediatamente precedente all'avvio della transazione
		file_put_contents("./log.csv", date(DATE_RFC822)."Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	mysqli_commit($link); // la transazione è stato completata con successo e quindi applico le modifiche ai dati originali
	mysqli_autocommit($link,TRUE); // imposto l'auto-commit a true
	return mysqli_stmt_affected_rows($stmt);
}

function delete_post($post_id_array) { // $post_id_array è un vettore all'interno del quale sono memorizzati gli id ei post di cui si sta richiedendo la cancellazione
	global $link;
	mysqli_autocommit($link, false); // disabilito l'auto-commit
	//mysqli_begin_transaction($link,MYSQLI_TRANS_START_READ_ONLY); // inizia la transazione
	$stmt = mysqli_prepare($link, DELETE_POST);
	foreach ($post_id_array as $id_current_post) {
		mysqli_stmt_bind_param($stmt,"i",$id_current_post);
		mysqli_stmt_execute($stmt);
		if (mysqli_errno($link)) {
			mysqli_rollback($link); // ripristino la configurazione della tabella talk_posts all'istante immediatamente precedente all'avvio della transazione
			mysqli_autocommit($link,TRUE);
			return FALSE;			
		}
	}
	mysqli_commit($link); // la transazione è stato completata con successo e quindi applico le modifiche ai dati originali
	mysqli_autocommit($link,TRUE); // imposto l'auto-commit a true
	return TRUE;
}

function update_post($dati_post,$id_post) {
	global $link;
	$stmt = mysqli_prepare($link, UPDATE_POST);
	mysqli_stmt_bind_param($stmt,"sssi",$dati_post['titolo'],$dati_post['contenuto'],$dati_post['categoria'],$id_post);
	mysqli_stmt_execute($stmt);
	if ( mysqli_stmt_affected_rows($stmt))
		return TRUE;
	else return FALSE;
}
?>