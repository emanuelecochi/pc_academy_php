<?php
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../shared/header.php';
?>
 <title>Visualizzazione Post</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron">
                    <h1>Post pubblicati</h1>
                </div>
                <div>
                	<button type="button" class="btn btn-primary" onclick="window.location='./homepage.php';">Torna alla home</button>
                </div>
            </div>
       </header>
       <div class="container">
       	<div class="row">
                <?php
                require_once '../model/file_manager.php';
                $dati_posts = select_all("../controller/posts.csv");
                $id_post = 0;
                foreach ($dati_posts as $post_corrente) {
                	echo "<div class='col-sm-4'>";
                	echo "<p><h4>",$post_corrente['titolo'],"</h4>";
                	echo "<span>",$post_corrente['categoria'],"</span></p>";
                	echo "<p><h4>Contenuto</h4>",$post_corrente['contenuto'],"</p>";
                	echo "<hr>";
                	echo "</div>";
                }
                ?>
       	</div>
       </div>
                    
    </body>
</html>