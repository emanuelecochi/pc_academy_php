<?php
require_once '../view/header.php';
require_once '../model/Usermanager.php';
$username = filter_input(INPUT_GET, "username", FILTER_VALIDATE_EMAIL);
if($username!==FALSE) {
    try {
            require_once '../shared/PDO_Connector.php';
            $dbh = PDO_Connector::get_connection();
            $usm = new UserManager($dbh);
            $usm->change_user_state($username);
            setcookie("username", $username, strtotime("+1 week"), "/");
            header("Location:../view/homepage.php");
    } catch (Exception $ex) {
        header("Location:../view/Error.php?msg=".$ex->getMessage());
    }
} else {
    header("Location:../view/Error.php?msg=Errore Generico");
}
