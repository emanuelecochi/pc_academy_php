    <div class="container col-sm-offset-2">
                <div class="row">
                <form id="login_form">
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
                    <div class="row">
                    <a href="./view/get_password.php">Forget Password? Click here!</a>
                    </div>    
            </div>

