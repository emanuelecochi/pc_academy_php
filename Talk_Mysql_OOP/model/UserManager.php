<?php

require_once 'DBManager.php';

class UserManager {
	const _REGISTER_USER = "INSERT INTO talk_users(username,password,nickname,avatar) VALUES (?,?,?,?);";
// 	const _ACTIVATE_USE = "UPDATE talk_users SET status = 'active' WHERE username = ?";
// 	const _DEACTIVATE_USER = "UPDATE talk_users SET status = 'offline' WHERE username = ?";
	const _CHANGE_USER_STATUS = "UPDATE talk_users SET status = ? WHERE username = ?";
	const _UPDATE_USER_PROFILE = "UPDATE talk_users SET nickname = ?, password = ?, avatar = ? WHERE username = ?";
	const _GET_MY_PROFILE = "SELECT * FROM talk_users WHERE username = ?";
	const _GET_ALL_PROFILE = "SELECT * FROM talk_users";
	const _IS_USER_EXIST = "SELECT nickname, avatar FROM talk_users WHERE (username=? OR nickname=?) AND password=? AND status='active'";
	private $link;
	
	function __construct() {
		$this->link = DBManager::get_instance();
	}
	/**
	 * Il metodo effetua il salvataggio dei dati relaitivi ad un nuovo utente al termine di questa operazione, il nuovo scritto si troverà 
	 * in uno stato denomianto registered che impedisce al momento dell'accesso alle funzionalità di scrittura del sito, tale stato sarà modificato 
	 * a seguito di un'attivazione invocabile per mezzo di un link presente all'intenro della mail che sarà inviata al termine della registrazione 
	 * @param array $param è un vettore al cui interno sono memorizzati temporaneamente i dati da salvare all'interno della tabella talk_users
	 * @throws RegistrationFailed si tratta di un'eccezione custom utilizzata per indicare il fallimento nel processo di registrazione
	 */
	public function registerUser($params) {
		$stmt = mysqli_prepare($this->link, self::_REGISTER_USER);
		mysqli_stmt_bind_param($stmt,"ssss",$params['username'],$params['password'],$params['nickname'],$params['avatar']);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new RegistrationFailed(mysqli_stmt_error($stmt), mysqli_stmt_errno($stmt));
		}
	}
	
	/**
	 * 
	 * @param string $username è l'indirizzo email dello user
	 * @param string $status indica quale status attribuire al profilo, i possibili valori
	 * sono active ed offline, il valore di default per questo parametro è active
	 * @throws ActivationFailed eccezione custom in cui sono riportati il messaggio e il codice di errore prodotti al processo di attivazione
	 */
	public function change_status($username,$status="active") {
		$stmt = mysqli_prepare($this->link,self::_CHANGE_USER_STATUS);
		mysqli_stmt_bind_param($stmt,"ss",$status,$username);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new ActivationFailed(mysqli_stmt_error($stmt), mysqli_stmt_errno($stmt));
		}		
	}
	
	public function upadate_profile($username,$new_password,$new_avatar,$new_nickname) {
		$stmt = mysqli_prepare($this->link,self::_UPDATE_USER_PROFILE);
		mysqli_stmt_bind_param($stmt,"ssss",$new_nickname,$new_password,$new_avatar,$username);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new UpdateProfileFailed(mysqli_stmt_error($stmt), mysqli_stmt_error($stmt));
		}
	}
	
	public function get_my_profile($username) {
		$stmt = mysqli_prepare($this->link,self::_GET_MY_PROFILE);
		mysqli_stmt_bind_param($stmt,"s",$username);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new GetProfileFailed(mysqli_stmt_error($stmt), mysqli_stmt_error($stmt));
		}
		return $stmt;
	}
	
	public function get_all_profile() {
		$stmt = mysqli_prepare($this->link,self::_GET_ALL_PROFILE);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new GetProfileFailed(mysqli_stmt_error($stmt), mysqli_stmt_error($stmt));
		}
		return $stmt;
	}
	
	public function is_user_exists($username,$password) {
		$stmt = mysqli_prepare($this->link,self::_IS_USER_EXIST);
		mysqli_stmt_bind_param($stmt,"sss",$username,$username,$password);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_errno($stmt)) {
			throw new LoginException(mysqli_stmt_error($stmt), mysqli_stmt_error($stmt));
		}
		else {
			mysqli_stmt_bind_result($stmt, $nickname, $avatar);
			mysqli_stmt_fetch($stmt); // restituisce un bool
			if(empty($nickname) || empty($avatar)) {
				// Le credenziali fornite non sono valide
				throw new LoginException("Login failed","Lg001");
			}
		}
	}
}
?>