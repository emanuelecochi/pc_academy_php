<?php
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../shared/header.php';
require_once '../model/PostsManager.php';
?>
        <title>Visualizzazione Post</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="jumbotron">
                <h1>Visualizzazione Posts</h1>
                </div>
            </div>
            <div class="container">
            <?php 
            $result = get_all_posts($_SESSION['nickname']);
            mysqli_stmt_bind_result($result, $id_post,$id_autore,$titolo,$testo_post,$categoria);
            $num = 1;
            while($row = mysqli_stmt_fetch($result)) {?>
            <p>
				<h2><?="Post $num: ".$titolo?></h3>
				<h4><?=$categoria?></h4>
				<?=$testo_post?>
            </p>
            <?php $num++;} ?>
            </div>    
        </header>
    </body>
</html>