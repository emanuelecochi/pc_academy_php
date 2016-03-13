<?php
 if(!filter_input(INPUT_COOKIE,'username'))
       header("Location:../index.php");  
 require_once '../model/shopping_cart.php';
 $cart = new shopping_cart;
?>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
    rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script>
        $(document).ready(function() {
           $('#add_to_cart').submit(function(evt){
               evt.preventDefault();
               alert("hi");
               $.ajax({
                         url:'../controller/add_to_cart.php',
                         type:'post',
                         data:$(this).serialize(),
                         success:function(data) {
                             if(data==='No product added') {
                                 alert(data);
                          } else $('#num_prod').html(data);
                        }
               });
           }); 
        });
    </script>    
  </head>
  
  <body>
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><span>Brand</span></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active">
              <a href="#">Home</a>
            </li>
            <li>
                <a href="../controller/logout.php">Logout</a>
            </li>
            <li>
                <a href="#">Contacts</a>
            </li>
            <li>
                <a href="shopping_cart.php"><span class="glyphicon glyphicon-shopping-cart"/><label style="z-index: 1;" id="num_prod"><?=$cart->get_count();?></label></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
   <?php
       require_once '../controller/Gui_Builder.php'; 
       $builder = new Gui_Builder;
       $builder->build_post_area();
       ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center text-primary">Team</h1>
            <p class="text-center">We are a group of skilled individuals.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png"
            class="center-block img-circle img-responsive">
            <h3 class="text-center">John Doe</h3>
            <p class="text-center">Developer</p>
          </div>
          <div class="col-md-4">
            <img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png"
            class="center-block img-circle img-responsive">
            <h3 class="text-center">John Doe</h3>
            <p class="text-center">Developer</p>
          </div>
          <div class="col-md-4">
            <img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png"
            class="center-block img-circle img-responsive">
            <h3 class="text-center">John Doe</h3>
            <p class="text-center">Developer</p>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>