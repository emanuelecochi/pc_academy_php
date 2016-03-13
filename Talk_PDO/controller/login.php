<?php
require_once '../model/UserManager.php';
require_once '../shared/PDO_Connector.php';
$dati_login = filter_input_array(INPUT_POST);
$dbh = PDO_Connector::get_connection();
$usm = new UserManager($dbh);
try {
        $user = $usm->is_user_exists($dati_login['username'], $dati_login['password']);
        setcookie("username", $user->nickname, strtotime("+1 week"), "/");
        print "ok";
} catch (Exception $ex) {
    print $ex->getMessage();
}
