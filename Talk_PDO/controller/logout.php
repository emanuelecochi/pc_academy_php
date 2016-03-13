<?php
setcookie("username", false, strtotime("-1 week"), "/");
header("Location:../index.php");

