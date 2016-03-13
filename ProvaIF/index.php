<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

        <title></title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron"> 
                    <h1> Test If </h1>
                </div>
            </div>
        </header>
        <div class="container"> 
            <form action="./report_tasse.php" method="POST"
                <p class="row">
                    <label for="nm">Nome:</label>
                    <input type="text" pattern="[A-Za-z ]+" required name="nome" id="nm" placeholder="Digita il nome">
                </p>
                <p class="row">
                    <label for="cgn">Cognome:</label>
                    <input type="text" pattern="[A-Za-z ]+" required name="cognome" id="cgn" placeholder="Digita il cognome">
                </p>
                <p class="row">
                    <label for="cf">Codice fiscale:</label>
                    <input type="text" pattern="([A-Za-z ]{6})(\d{2})[A-Za-z](\d{2})([A-Za-z]\d{3}[A-Za-z])" required name="cf" id="cf" placeholder="Digita il codice fiscale">
                </p>
                <p class="row">
                    <label for="cf">Reddito:</label>
                    <input type="number" required name="reddito" id="rdd" placeholder="Digita il reddito" min="0" step="50">
                </p>
                <p class="btn-group btn-group-lg" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary">Invia</button>
                    <button type="reset" class="btn btn-primary">Annulla</button>
                </p>
            </form>
        </div>
        <footer>

        </footer>
        <?php
        // put your code here
        ?>

    </body>
</html>
