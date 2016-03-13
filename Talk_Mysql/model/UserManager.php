<?php 
/**
 * In questo file  saranno implementate le funzioni necessarie alla manipolazioene 
 * dei dati relativi agli utenti registrati al servizio Talk
 */
require_once 'DBManager.php';
define("TEST_USER", "SELECT * FROM talk_users WHERE username='%s' OR nickname='%s' OR password='%s'");
define("NEW_USER", "INSERT INTO talk_users(username,password,nickname,avatar) VALUES('%s','%s','%s','%s')");
define("SEARCH_USER", "SELECT nickname FROM talk_users WHERE (username='%s' or nickname='%s') AND password='%s' AND status='active'");
define("SEARCH_CREDENTIALS","SELECT username,nickname,password FROM talk_users WHERE (username='%s' or nickname='%s') AND status='active'");
define("UPDATE USER", "UPDATE talk_users SET username='%s', password='%s', nickname='%s', avatar='%s' WHERE username='%s'");
define("SUSPEND_USER", "UPDATE talk_users SET status='offline WHERE username='%s'");
define("ACTIVATE_USER", "UPDATE talk_users SET status='active' WHERE username='%s'");
$link = connect();
/**
 * 
 * @global type $link
 * @param array $data contiene i dati necessari al completamento della registrazione.
 * In particolare questi sono organizzati in una struttura associativa avente le seguenti chiavi
 * <ul>
 * <li>usn: identifica il valore dell'username, il quale risulta essere l'indirizzo email</li>
 * <li>pwd: identifica il valore dell password, il quale risulta essere l'indirizzo email</li>
 * <li>nick: identifica il valore dell nickname</li>
 * <li>avt: è il nome dell'immagine utilizzata come avatar di default è defautl.png</li>
 */ 
function test_user($email,$nickname,$password){
	global $link;
	$result = mysqli_query($link, sprintf(TEST_USER, $email,$nickname,$password));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": save_user Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	} else mysqli_num_rows($result)>0;
}

function save_user($data) {
	global $link; //link è la varabile globale definita fuori dalla funzione
	mysqli_query($link, sprintf(NEW_USER, $data['email'],$data['password'],$data['nickname'],$data['avatar']));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": save_user Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
		} else return mysqli_affected_rows($link); // restituisce il numero di record inseriti, modificati
}

function is_user_exists($usn,$pwd) {
	global $link;
	// MYSQLI_ASSOC: mysqli_query restituisce un cursore quindi con MYSQLI_ASSOC si otterà un vettore con il contenuto della query
	$result = mysqli_query($link, sprintf(SEARCH_USER,$usn,$usn,$pwd));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": is_user_exists Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	// restituisce il numero di record della select
	if(mysqli_num_rows($result)) {
		// il reslut è diverso dall'insieme vuoto, quindi esiste un utente con le credenziali inserite in input
		session_start();
		// mysqli_fetch_array fornisce la prima riga del risultati e va avanti in caso sia arrivato alla fine restituisce false
		$user_data = mysqli_fetch_array($result);
		$_SESSION['nickname'] = $user_data['nickname'];
		return TRUE;
	} else return FALSE;
}

function user_credentials($usn) {
	global $link;
	$result = mysqli_query($link, sprintf(SEARCH_CREDENTIALS,$usn,$usn));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": user_credentials Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	} else return mysqli_fetch_array($result);
// 	if(mysqli_num_rows($result)) {
// 		$user_data = mysqli_fetch_array($result);
// 		$user['email'] = $user_data['username'];
// 		$user['nickname'] = $user_data['nickname'];
// 		$user['password'] = $user_data['password'];
// 		return $user;
// 	} else return FALSE;
}

function update_user($username,$param) {
	global $link;
	$result = mysqli_query($link, sprintf(UPDATE_USER, $param['username'],$param['password'],$param['nickname'],$param['avatar'],$param['username']));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": update_user Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	return mysqli_affected_rows($link)>0;
}

function suspend_user($username) {
	global $link;
	mysqli_query($link, sprintf(SUSPEND_USER,$username));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": suspend_user Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE;
	}
	return mysqli_effected_rows($link)>0;
}

function activate_new_user($username) {
	global $link;
	mysqli_query($link, sprintf(ACTIVATE_USER,$username));
	if(mysqli_errno($link)) {
		file_put_contents("./log.csv", date(DATE_RFC822).": activate_new_user Errore(".mysqli_errno($link)."):".mysqli_error($link).PHP_EOL, FILE_APPEND|LOCK_EX);
		return FALSE; 
	}
	return mysqli_affected_rows($link)>0;
}

?>