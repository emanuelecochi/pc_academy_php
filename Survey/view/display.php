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
                    <h1> La tua scheda personale </h1>
                </div>
            </div>
        </header>
        <div class="container">
        <?php 
        	$dati_form= filter_input_array(INPUT_POST);
        	$foto= $_FILES['foto'];
        	/*
        	 * name è il nome del file privo di path
        	 * error è il codice numerico di errore
        	 * tmp_name è il nome temporaneo all'interno della directory tmp del web server
        	 * size è la dimensione del file
        	 * mimetype identifica il tipo del file (jpg, png..)
        	 */
        	foreach ($dati_form as $key => $value) {
        		echo "<p>";
        		echo ucfirst(str_replace("_"," ",$key)),":", strtoupper($value);
        		if (is_array($value)) {
        				$value = "<b>".implode(" ",$value)."</b>";
        				echo $value;
        			}
        		}
        		echo "</p>";
        	move_uploaded_file($foto['tmp_name'],"../images/".$foto['name']);
        ?>
        <p>
        <img src="../images/<?=$foto['name'];?>"/>
        </p>
        </div>
        <footer>
        	Powered by Bootstarp &copy;
        </footer>
    </body>
</html>