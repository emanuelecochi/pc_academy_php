<?php
require_once 'Post.php';
require_once '../shared/Logger.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostManager
 *
 * @author Corso Programmazione
 */
class PostManager {
    private $dbh;
    const _SAVE_POST = "INSERT INTO talk_posts(id_autore,titolo,testo_post,categoria,immagine_copertina,costo) VALUES(:id_autore,:titolo,:testo,:categoria,:copertina,:costo)";
    const _SELECT_LAST_POSTS = "SELECT * FROM talk_posts ORDER BY id_post DESC LIMIT 5";
    public function __construct($conn) {
        $this->dbh = $conn;
    }
    public function select_last_posts() {
       try { 
        $stmt = $this->dbh->prepare(self::_SELECT_LAST_POSTS);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Post",
                array("idp","ida","tit","text","cat","imm"."cst"));
        return $result;
       } catch (PDOException $ex) {
           Logger::log($ex->getCode(), $ex->getMessage());
           throw new Exception("Impossible load last 5 posts, there was an error");
       }
    }
    public function save_post($post_data) {
        try {
              $path = "./images/".$post_data['copertina'];    
            $stmt = $this->dbh->prepare(self::_SAVE_POST);
                $stmt->bindParam(":id_autore",$_COOKIE['username'],PDO::PARAM_STR);
                $stmt->bindParam(":titolo",$post_data['titolo'],PDO::PARAM_STR);
                $stmt->bindParam(":testo",$post_data['contenuto'],PDO::PARAM_STR);
                $stmt->bindParam(":categoria",$post_data['categoria'],PDO::PARAM_STR);
                $stmt->bindParam(":copertina",$path,PDO::PARAM_STR);
                $stmt->bindParam(":costo",$post_data['costo'],PDO::PARAM_STR);
                $stmt->execute();
              } catch (PDOException $ex) {
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("Failed save post");
        }
    }
}
