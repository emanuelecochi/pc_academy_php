<?php 
require_once '../shared/PDO_Connector.php';

class Shopping_cart {
	private $dbh;
	const _ADD_PRODUCT = "INSERT INTO talk_shopping_cart(id_articolo,username) VALUES(:id_art,:usn)";
	const _REMOVE_PRODUCT = "DELETE FROM talk_shopping_cart WHERE id=:id_voce";
	const _REMOVE_MY_PRODUCTS = "DELETE FROM talk_shopping_cart WHERE username=:usn";
	const _SELECT_MY_PRODUCTS = "SELECT * FROM talk_shopping_cart WHERE username=:usn";
	const _COUNT_MY_PRODUCT = "SELECT COUNT(*) as cart FROM talk_shopping_cart WHERE username=:usn";
	public function __construct() {
		$this->dbh = PDO_Connector::get_connection();
	}
	
	public function add_product($id_art) {
		try {
			$stmt = $this->dbh->prepare(self::_ADD_PRODUCT);
			$stmt->bindParam(":id_art",$id_art,PDO::PARAM_INT);
			$stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'),PDO::PARAM_STR);
			$stmt->execute();	
			$stmt = $this->dbh->prepare(self::_COUNT_MY_PRODUCT);
			$stmt->bindParam(":usn",filter_input(INPUT_COOKIE,'username'),PDO::PARAM_STR);
			$stmt->execute();
			$cursor = $stmt->fetch(PDO::FETCH_OBJ);
			return $cursor
		} catch (PDOException $ex) {
			Logger::log($ex->getCode(), $ex->getMessage());
			throw new Exception("No product added");
		}
	}
}
?>