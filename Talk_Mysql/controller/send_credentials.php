<?php 
$user = filter_input ( INPUT_POST, 'nickname/email');
require_once '../model/UserManager.php';
$result = user_credentials($user);
echo $result;
if (($result==FALSE) || ($result==NULL)) {
	print("Errore nessuna password inviata");
} else {
	$message = "<html><body>Le tue credenziali sono: <br>
				<p>Nickname: ".$result['nickname'].
 				"<br>Email: ".$result['username'].
 				"<br>Password: ".$result['password'].
 				"</p></body></html>";
	$header = "MIME-Version: 1.0 \r\n" . "Content-type: text/html; charset=iso-8859-1 \r\n" . "From: Administator Talk <yourmailexample@domain.com>";
	mail($result['username'],"Send Credentials",$message,$header);
		echo "Ti è stata appena inviata una mail con le tue credenziali";
  } 
?>