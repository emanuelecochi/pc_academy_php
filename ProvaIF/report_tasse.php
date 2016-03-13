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
        <?php
        $nome_contribuente = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_ENCODED);
        $cognome_contribuente = filter_input(INPUT_POST, 'cognome',FILTER_SANITIZE_ENCODED);
        $reddito_contribuente = filter_input(INPUT_POST, 'reddito',FILTER_VALIDATE_INT);
        $codice_fiscale_contribuente = filter_input(INPUT_POST, 'cf');
        
        $tasse = 0;
        if ($reddito_contribuente>5000 && $reddito_contribuente<10000) {
            $tasse = 500;
        }  
        elseif ($reddito_contribuente>=10000 && $reddito_contribuente<20000) {
            $tasse = 1000;
        } else {
            $tasse = ($reddito_contribuente*1000)/20000;
        }   
        ?>
        <div class="container">
            <div class="jumbotron">
                <h1> Tasse da pagare </h1>
            </div>
            <p class="row">
            <h3>Nome:</h3><?=$nome_contribuente;?>
            </p>
            <p class="row">
            <h3>Cognome:</h3><?=$cognome_contribuente;?>
            </p>
            <p class="row">
            <h3>Cofice fiscale:</h3><?=$codice_fiscale_contribuente;?>
            </p>
            <p class="row">
            <h3>Reddito:</h3><?=$reddito_contribuente;?>
            </p>
            <p class="row">
            <h1>Imposte dovute:<?=$tasse;?>&euro;<h1>
            </p>
        </div>
    </body>
</html>
