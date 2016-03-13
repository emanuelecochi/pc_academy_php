<?php 
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['admin_logged'])) {
	// colui che sta tentando di accedere alla pagina di amministrazione non è un utente autorizzato
	header("Location:../index.php");
}
require_once '../../shared/header.php';
require_once 'UserToolbar.php';
$drawer = new UserToolbar;
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Talk Administration Page</a>
    </div>
    <ul class="nav navbar-nav">
    <?php 
    $functions = parse_ini_file("../model/admin_functions.ini", true);
    foreach ($functions as $label => $array_sub_funtions) {
    	$drawer->drawDropDownButton($label,$array_sub_funtions);
    }
    
    ?>
    </ul>
  </div>
</nav>