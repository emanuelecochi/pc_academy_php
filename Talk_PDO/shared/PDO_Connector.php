<?php
require_once 'Logger.php';
require_once 'Talk_Config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDO_Connector
 *
 * @author Corso Programmazione
 */
class PDO_Connector {
    private static $connection=null;
    private function __construct() {
        try {
        self::$connection = new PDO("mysql:host=".Talk_Config::_HOSTNAME.";dbname=".Talk_Config::_DBNAME, 
        Talk_Config::_DBUSER, Talk_Config::_DBPASSWORD);
         } catch(PDOException $ex) {
            self::$connection=null;
            Logger::log($ex->getCode(),$ex->getMessage());
           
         }
        }
    public static function get_connection() {
        if(self::$connection==NULL)
            new PDO_Connector;
        return self::$connection;
    }
}
