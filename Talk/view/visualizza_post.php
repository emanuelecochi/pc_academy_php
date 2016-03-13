<?php
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../shared/header.php';
require_once '../model/file_manager.php';
$dati_posts = select_all("../controller/posts.csv");
$nPost = $_GET['numeroPost'];
?>
        <title>Visualizzazione Post</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron">
                    <h1><?=$dati_posts[$nPost-1]['titolo']?></h1>
                    <h3>Categoria: <?=$dati_posts[$nPost-1]['categoria']?></h3>
                </div>
            </div>
            <div class="container">
            <?=str_replace("\""," ",$dati_posts[$nPost-1]['contenuto'])?>
            </div>
        </header>
    </body>
</html>