<?php
require_once 'User.php';
require_once '../shared/Logger.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserManager
 *
 * @author Corso Programmazione
 */
class UserManager {
    private $connection; // conterrà la connessione PDO al DB
    const _CREATE_USER = "INSERT into talk_users(username,password,nickname,avatar) VALUES(:usn,:pwd,:nck,:avt)";
    const _DELETE_USER = "DELETE talk_users,talk_posts FROM talk_users NATURAL JOIN talk_posts WHERE talk_users.username=:usn";
    const _CHANGE_USER_STATE = "UPDATE talk_users SET status=:state WHERE username=:usn";
    const _GET_USER_DATA = "SELECT username,password,nickname,avatar FROM talk_users WHERE username=:usn";
    const _LOGIN_USER = "SELECT nickname FROM talk_users WHERE (username=:username OR nickname=:username) AND password=:password AND status='active'";
    public function __construct($dbh) {
        $this->connection = $dbh;
    }
    public function is_user_exists($username,$password) {
        
        try {
                $stmt = $this->connection->prepare(self::_LOGIN_USER);
                $stmt->bindParam(":username",$username,PDO::PARAM_STR);
                $stmt->bindParam(":password", $password,PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if($user!==FALSE)
                   return $user;
               throw new Exception("Login Failed");
        } catch (PDOException $ex) {
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("System Error");
        }
    }
    public function get_user_data($username) {
        try {
        $stmt = $this->connection->prepare(self::_GET_USER_DATA);
        $stmt->bindParam(":usn",$username,PDO::PARAM_STR);
        $stmt->execute();
        $selected_user = $stmt->fetch(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,
                "User",array("usn","pwd","nick","avt"));
        return $selected_user;
        } catch(PDOException $ex) {
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("Select user data failed");
        }
    }
    public function change_user_state($username,$status='active') {
       try { 
        $stmt = $this->connection->prepare(self::_CHANGE_USER_STATE);
        $stmt->bindParam(":state",$status,PDO::PARAM_STR);
        $stmt->bindParam(":usn",$username,PDO::PARAM_STR);
        $stmt->execute();
       } catch(PDOException $ex) {
           Logger::log($ex->getCode(), $ex->getMessage());
           throw new Exception("Change status failed");
       }
    }
    public function delete_user($username) {
        try {
             $this->connection->beginTransaction();
             $stmt = $this->connection->prepare(self::_DELETE_USER);
             $stmt->bindParam(":usn",$username,PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
        } catch (PDOException $ex) {
            $this->connection->rollback();
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("Delete user failed");
        }
    }
    public function create_user($form_data) {
        try {
            $stmt = $this->connection->prepare(self::_CREATE_USER);
                $stmt->bindParam(":usn",$form_data['username'],PDO::PARAM_STR);
                $stmt->bindParam(":pwd",$form_data['password'],PDO::PARAM_STR);
                $stmt->bindParam(":nck",$form_data['nickname'],PDO::PARAM_STR);
                $stmt->bindParam(":avt",isset($form_data['avatar'])?$form_data['avatar']:'default.png',PDO::PARAM_STR);
                $stmt->execute();
        } catch(PDOException $ex) {
             Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("Registration Failed");
        }
        
        }
}
