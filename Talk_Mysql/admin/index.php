<?php
session_start();
if(!isset($_SESSION['nickname']))
    header("Location:../index.php");
 require_once '../shared/header.php';
?>
</head>
<body>
    <header>
        <div class="container">
            <div class="jumbotron">
                <h1>Manage your posts</h1>
            </div>
        </div>
        <div class="container">
            <?php 
            require_once '../model/PostsManager.php';
            $result = get_all_posts($_SESSION['nickname']);
            echo "<form action='./controller/delete_post.php' method='post'>";
            mysqli_stmt_bind_result($result, $id_post,$id_autore,$titolo,$testo_post,$categoria);
            while($row = mysqli_stmt_fetch($result)) {?>
            <p>
                <input type="checkbox" name="id_post[]" value="<?=$id_post?>">
                <div class="col-sm-3"><b><h1><?=$titolo?></h1></b></div>
                <div class="col-md-offset-6 col-sm-3 btn-group-lg">
                    <button type="button" class="btn btn-primary" 
                            onclick="window.location='./view/edit_post.php?id_post=<?=$id_post?>';">
                    Update Post
                    </button>
                    <button type="button" class="btn btn-primary" 
                            onclick="window.location='./controller/delete_post.php?id_post=<?=$id_post?>';">
                    Delete Post
                    </button>
                </div>
            </p>
            <?php } ?>
            <p class="btn-group-lg">
            <button type="submit" class="btn btn-primary">Delete Selected Posts</button>
            <button type="button" class="btn btn-primary" 
                    onclick="window.location='./controller/delete_post.php?id_post=all';">Delete all posts</button> <!-- la parola all non viene letta dallo switch di delete_post.php  --> 
            </p>
        </form>
        </div>
    </header>
    
</body>