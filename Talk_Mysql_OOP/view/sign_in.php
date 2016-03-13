<?php
  require_once '../shared/header.php';
  ?>
  <title></title>
    </head>
    <body>
        <header>
            <div class='container'>
                <div class='jumbotron'>
                    <h1><span class='glyphicon glyphicon-user'>&nbsp;
                        </span>Registration</h1>
                </div>
            </div> 
        </header>  
        <div class='container'>
            <form action='../controller/sign_in.php' method='post' 
                  enctype="multipart/form-data">
                <p>
                    <label for='email'><span class="glyphicon glyphicon-envelope">&nbsp;</span>Email:</label>
                    <input type='email' name='username' id='email' required 
                           placeholder="mario.rossi@comune.it">
                </p>
                <p>
                    <label for='nickname'><span class='glyphicon glyphicon-user'>&nbsp;
                        </span>Nickname:</label>
                    <input type='text' name='nickname' id='nickname' required 
                           placeholder="Choose your nickname" pattern='(\w){5,}' > 
                </p>
                <p>
                    <label for="password"><pan class="glyphicon glyphicon-lock">&nbsp;</pan>Password:</label>
                    <input type="password" name="password" id="password" 
                           pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$" placeholder="ASPgo123">
                </p>
                
                <p>
                    <label for="avatar">
                    Avatar:
                    </label>
                    <input type="file"  name="avatar" id="avatar"   
                           pattern="^(.+)\.(jpg|png|svg|bmp)$" >
                    
                </p>
                <p class="btn-group btn-group-lg" role="group" ><!-- creo un button group -->
                        <button type="submit" class="btn btn-primary"><!--pulsante con sfondo blu arrotondato-->
                            <span class="glyphicon glyphicon-pencil">&nbsp;</span>Register</button> <!-- glifo con l'immagine di un utente stilizzato -->
                        <button type="reset" class="btn btn-primary">
                            <span class="glyphicon glyphicon-trash">&nbsp;</span>
                            Cancel!</button>
                           
                    </p>
            </form>    
        </div>
    </body>
  </html>

