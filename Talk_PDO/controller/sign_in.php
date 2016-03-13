<?php
$form_data = filter_input_array(INPUT_POST);
require_once "../model/UserManager.php";
require_once "../shared/PDO_Connector.php";
$usm = new UserManager(PDO_Connector::get_connection());
try {
    /*
     * Descrizione situazione prevista:
     * Invoco il metodo di salvataggio passando al metodo le infomrazioni provenienti dalla form
     * Invio mail per la conferma
     */
    if(isset($_FILES['avatar'])) {
        $image_info = $_FILES['avatar'];
        move_uploaded_file($image_info['tmp_name'],
                "images/".$form_data['username']."/".$image_info['name']);
        $form_data['avatar']=$image_info['avatar'];
    }
    $usm->create_user($form_data);
    $message="<html><body>Congratulation your registration is complete. Activate using link below<br/> 
            <a href='www.yoursiteexample.org/Talk_PDO/controller/".
            "activate.php?username={$form_data['username']}'>Activate</a></body></html>";
        mail($form_data['username'], 
                "Welcome on Talk we're better than Wordpress", $message,
                "MIME-Version: 1.0 \r\n".
                "Content-type: text/html; charset=iso-8859-1 \r\n".
                "From:Administrator Talk <yourmailexample@domain.com> \r\n");    
        echo "Registrazione completata con successo.<br/>Ti è stata appena inviata una mail con cui "
        . "potrai attivare il tuo account e accedere così ai servizi del nostro sito";  
   
} catch (Exception $ex) {
    /*
     * Descrizione eccezione salvataggio fallito
     */
    header("Location:../view/error.php?error_message=".$ex->getMessage());
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

