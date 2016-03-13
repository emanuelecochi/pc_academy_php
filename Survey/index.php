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
                    <h1> Scheda Personale </h1>
                </div>
            </div>
        </header>
        <div class="container">
        	<form action="./view/display.php" method="post" enctype="multipart/form-data">
        		<p>
        			<label for="name">Nome:</label><input type="text" pattern="[A-Za-z]([A-Za-z ])*" required placeholder="digita il tuo nome" id="nome" name="nome">
        		</p>
        		<p>
        			<label for="cognome">Cognome:</label><input type="text" pattern="[A-Za-z]([A-Za-z ])*" required placeholder="digita il tuo cognom" id="cognome" name="cognome">
        		</p>
        		<p>
        			<label for="img">Foto:</label><input type="file" pattern="(.+)\.(jpg|png|bmp|svg|)" id="img" name="foto">
        		</p>
        		<h3>Interessi</h3>
        		<input type="checkbox" name="interessi[]" value="musica">Musica
        		<input type="checkbox" name="interessi[]" value="cinema">Cinema
        		<input type="checkbox" name="interessi[]" value="fotografia">Fotografia
        		<input type="checkbox" name="interessi[]" value="cucina">Cucina
        		<input type="checkbox" name="interessi[]" value="lettura">Lettura
        		<input type="checkbox" name="interessi[]" value="dormire">Dormire
        		</p>
        		<p>
        		<h3>Stato civile</h3>
        		<input type="radio" name="stato_civile" value="celibe">Celibe
        		<input type="radio" name="stato_civile" value="coniugato">Coniugato
        		<input type="radio" name="stato_civile" value="convivente">Convivente
        		<input type="radio" name="stato_civile" value="non so">Non so
        		</p>
        		<p>
        			<button type="submit" class="btn btn-primary">Invia</button>
        			<button type="reset" class="btn btn-primary">Annulla</button>
        		</p>
        	</form>
        </div>
    	</header>
    </body>
</html>