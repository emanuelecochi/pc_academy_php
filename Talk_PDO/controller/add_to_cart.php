<?php
   require_once '../model/shopping_cart.php';
   $cart = new shopping_cart();
   try {
        $res= $cart->add_product(filter_input(INPUT_POST,'id_articolo',FILTER_VALIDATE_INT));
        if(isset($_COOKIE['cart'])) {
            $new_val = $_COOKIE['cart']+1;
            setcookie("cart", $new_val);
        } else setcookie("cart", 1);
          print $res;
   } catch (Exception $ex) {
          print $ex->getMessage();
   }
