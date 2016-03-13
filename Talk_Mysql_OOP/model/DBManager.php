<?php

require_once 'Talk_Config.php';
require_once '../shared/logger.php';

/**
 * Questa classe si occupa di gestire la connessione verso il db
 */
class DBManager {
	private static $link;
	private static $instance = null;
	
	private function __construct() {
		self::$link = mysqli_connect(Talk_config::_DBURL, Talk_config::_DBUSER, Talk_config::_DBPASSWORD, Talk_config::_DBNAME);
		if(mysqli_errno(self::$link)) {
			throw new Exception(mysqli_error(self::$link), mysqli_errno(self::$link));
		}
	}
	
	public static function get_instance() {
		if(self::$instance==null) {
			try {
				self::$instance = new DBManager();
				return self::$link;
			} catch (Exeception $ex) {
				Logger::save_log($ex->getMessage(), $ex->getCode());
				return null;
			}
		}
	}
}
?>