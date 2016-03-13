<?php
if(!filter_input(INPUT_COOKIE,'username'))
       header("Location:../index.php");  
   session_start();
require_once '../shared/PDO_Connector.php';
require_once '../model/shopping_cart.php';
require_once '../shared/header.php';
$payment_amount=0;
$cart = new shopping_cart();
$my_cart = $cart->select_my_products();
echo "</head><body><form action='../controller/del_article_from_shopping_cart.php' method='post'>";
foreach($my_cart as $current_product) {
    $payment_amount+=$current_product->totale;
    $row=<<<ROW
            <div class="row">
            <div class="col-sm-1"><input type='checkbox' name='trashed[]' value='$current_product->id_post'></div>
            <div class="col-sm-2 img-responsive"><img src='$current_product->immagine_copertina'/></div>
            <div class="col-sm-4 jumbotron"><h2>$current_product->titolo</h2></div>
            <div class="col-sm-1">$current_product->acquistati</div>
            <div class="col-sm-2">$current_product->totale</div>
            <div><button type='button' onclick="window.location='../controller/del_article_from_shopping_cart.php?trashed=$current_product->id_post'">Remove</button></div>
            </div>
ROW;
    echo $row;
}
$total_row=<<<TOTAL
        <div class="row">
        <div class="col-sm-6 pull-right">
        <h2>Totale:$payment_amount &euro;</h2>
        </div>
        </div>
TOTAL;
echo $total_row;
$del_button=<<<DEL
        <div class="row">
        <button type="submit">Remove selected item</button>    
        </div>
        </form>
DEL;
echo $del_button;
$_SESSION['Payment_Amount']=$payment_amount;
?>
<form action='../paypal/expresscheckout.php' METHOD='POST'>
<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' 
       border='0' align='top' alt='Check out with PayPal'/>
</form>

