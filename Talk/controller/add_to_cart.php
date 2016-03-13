<?php 
require_once '../model/shopping_cart.php';

$cart = new Shopping_cart();
try {
	$res = $cart->add_product(filter_input(INPUT_GET,'id_articolo',FILTER_VALIDATE_INT));
	if(isset($_COOKIE['cart'])) {
		$new_val = $_COOKIE['cart'] + 1;
		setcookie("cart",$new_val);		
	} else setcookie("cart",1); 
	print "ok";
} catch (Exception $ex) {
	print $ex->getMessage();
}
?>