<?php
if(!filter_input(INPUT_COOKIE,'username'))
        header("Location:../index.php");
$trash = $_REQUEST['trashed'];
if(!is_array($trash))
    $trash = [$trash];
$trash = filter_var_array ($trash,FILTER_VALIDATE_INT);
require_once '../model/shopping_cart.php';
$cart = new shopping_cart;
foreach($trash as $id_post) 
    $cart->remove_article($id_post);
header("location:../view/shopping_cart.php");