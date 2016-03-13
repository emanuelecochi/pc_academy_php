<?php
require_once './shared/header.php';
//include_once './shared/header.php';
?>
<script>
	 $(document).ready(function() {
		 $('#login_form').submit(function(evt) {
			 evt.preventDefault(); //impedisce l'invio dei dati dalla form
			 $.ajax({ // richiesta asincrona, rimangono nella pagina dopo aver inviato i dati della form 
				 		url:'./controller/login.php',
				 		method:'POST',
				 		data:$('#login_form').serialize(), //spedizione dei dati dopo essere serializzati chiave->valore
				 		success:function(data) { //data contiene i dati inviati da login
					 		if(data=="ok")
						 		window.location="./view/homepage.php";
					 		else alert(data)
				 		},
				 		error:function(data) {
					 		alert("Errore:"+data);
				 		}
			 });
		 });
	 });
</script>
        <title></title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron">
                    <h1>Talk about yourself</h1>
                </div>
            </div>
            <div class="container">
                <form action="./controller/login.php" method="post" id=login_form>
                    <p><label for="username">Nickname/Email:</label>
                        <input type="text" name="email" id="username" 
                               pattern="(\w+|(^([\w\._])+@([\w\._])+\.([\w]{2,})$))"
                               required placeholder="email o nickname indicati in fase di registrazione">
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="123456789" required>
                    </p>
                    <p class="btn-group btn-group-lg" role="group" ><!-- creo un button group -->
                        <button type="submit" class="btn btn-primary"><!--pulsante con sfondo blu arrotondato-->
                            <span class="glyphicon glyphicon-user">&nbsp;</span>Login!</button> <!-- glifo con l'immagine di un utente stilizzato -->
                        <button type="reset" class="btn btn-primary">
                            <span class="glyphicon glyphicon-trash">&nbsp;</span>
                            Cancel!</button>
                            <button type="button" onclick="window.location='./view/sign_in.php';" 
                                class="btn btn-primary"><span class="glyphicon glyphicon-pencil">&nbsp;</span>
                            Sign in!</button>
                    </p>
                    <a href="./view/forgot_credentials.php"><br>Hai dimenticato le tue credenziali?</a>
                </form>
            </div>    
        </header>
    </body>
</html>
