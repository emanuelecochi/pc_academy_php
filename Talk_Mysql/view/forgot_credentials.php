<?php
require_once '../shared/header.php';
?>
<script>
$(document).ready(function () {
	$('#credentials_form').submit(function(evt) {
		evt.preventDefault();
		if($('#g-recaptcha-response').val()=='')
			alert("Seleziona il captcha");
		else {
			$.ajax({ // richiesta asincrona, rimangono nella pagina dopo aver inviato i dati della form 
	 			url:'../controller/send_credentials.php',
	 			method:'POST',
	 			data:$('#credentials_form').serialize(), //spedizione dei dati dopo essere serializzati chiave->valore
	 			success:function(data) { //data contiene i dati inviati da add_post
		 			alert(data);
	 			},
	 			error:function(request, status, error) {
					alert(request.responseText);
		 	}
 		});
		}
	});
});
</script>
<title>Invio credenziali</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron">
                    <h1>Invio credenziali</h1>
                </div>
            </div>
            <div class="container">
                <form action="../controller/send_credentials.php" method="post" id=credentials_form>
                <label for="credentials">Nickname/Email</label>
                <input type="text" name="nickname/email" placeholder="Inserisci email o nickname" required>
                <br><br>
                <div class="g-recaptcha" data-sitekey="6LfUgxgTAAAAAK93MWLJ2KmRiexquUUpx7oy_4LI"></div>
                <br>
                <p class="btn-group btn-group-lg" role="group" ><!-- creo un button group -->
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-envelope">&nbsp;</span>Invia</button> 
                        <button type="reset" class="btn btn-primary">
                            <span class="glyphicon glyphicon-trash">&nbsp;</span>Cancel!</button>
                </p>
            </div>
        </header>
    </body>
</html>