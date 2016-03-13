<?php
if(filter_input(INPUT_COOKIE,'username')===FALSE)
    header ("Location:../index.php");
require_once '../model/PostManager.php';
require_once '../shared/PDO_Connector.php';
$dbh = PDO_Connector::get_connection();
$pm = new PostManager($dbh);
$post_data = filter_input_array(INPUT_POST);
$post_data['copertina'] = $_FILES['copertina']['name'];
if(!file_exists("../view/images"))
{
    mkdir("../view/images");
}
move_uploaded_file($_FILES['copertina']['tmp_name'], "../view/images/".$_FILES['copertina']['name']);
try {
      $pm->save_post($post_data);
      
      print "Salvataggio completato con successo";
} catch(Exception $ex) {
    print "Error";
}
