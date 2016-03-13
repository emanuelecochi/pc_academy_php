<?php
require_once './shared/header.php';
//include_once './shared/header.php';
?>
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
                <form action="./controller/login.php" method="post">
                    <p><label for="username">Nickname/Email:</label>
                        <input type="text" name="username" id="username" 
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
                </form>
            </div>    
        </header>
    </body>
</html>
