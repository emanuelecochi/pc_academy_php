<?php
require_once '../shared/PDO_Connector.php';
require_once '../shared/Logger.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shopping_cart
 *
 * @author Corso Programmazione
 */
class shopping_cart {
    private $dbh;
    const _ADD_PRODUCT = "INSERT INTO talk_shopping_cart(id_articolo,username) VALUES(:id_art,:usn)";
    const _REMOVE_MY_PRODUCTS = "DELETE FROM talk_shopping_cart WHERE username=:usn";
    const _SELECT_MY_PRODUCTS = "SELECT id_post,titolo,immagine_copertina,sum(costo) as totale,count(*) AS acquistati FROM talk_shopping_cart NATURAL JOIN talk_posts WHERE username=:usn GROUP BY talk_shopping_cart.id_post";
    const _COUNT_MY_PRODUCT = "SELECT COUNT(*) as cart FROM talk_shopping_cart WHERE username=:usn";
    const _REMOVE_ARTICLE = "DELETE FROM talk_shopping_cart WHERE id_post=:id_post AND username=:usn LIMIT 1";
    public function __construct() {
        $this->dbh = PDO_Connector::get_connection();
    }
    public function remove_article($id_post) {
      try {  
        $stmt = $this->dbh->prepare(self::_REMOVE_ARTICLE);
        $stmt->bindParam(":id_post",$id_post,PDO::PARAM_INT);
        $stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'),PDO::PARAM_STR);
        $stmt->execute();
      } catch(PDOException $ex) {
          Logger::log($ex->getCode(),$ex->getMessage());
          throw new Exception("Error trashed article");
      }  
    }
    public function select_my_products() {
        try {
        $stmt = $this->dbh->prepare(self::_SELECT_MY_PRODUCTS);
        $stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'),PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $ex) {
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("No product in cart");
        }
    }
    public function add_product($id_art) {
        try {
                $stmt = $this->dbh->prepare(self::_ADD_PRODUCT);
                $stmt->bindParam(":id_art",$id_art,PDO::PARAM_INT);
                $stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'),PDO::PARAM_STR);
                $stmt->execute();
                return $this->get_count();
        } catch(PDOException $ex) {
            Logger::log($ex->getCode(), $ex->getMessage());
            throw new Exception("No product added");
        }
        
    }
    public function get_count() {
         $stmt = $this->dbh->prepare(self::_COUNT_MY_PRODUCT);
                $stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'));
                $stmt->execute();
                $cursor = $stmt->fetch(PDO::FETCH_OBJ);
                return $cursor!==  FALSE ?$cursor->cart:0;
    }
}
