<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="./css/my_css.css" rel="stylesheet" type="text/css">
      </head>
      <body>

        <div class="cover"> <div class="navbar navbar-default">
                <div class="container"> 
                    <div class="navbar-header"> 
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span><span class="icon-bar"></span></button> 
                        <a class="navbar-brand" href="#"><span>Brand</span></a> </div>
                    <div class="collapse navbar-collapse" id="navbar-ex-collapse"> 
                        <ul class="nav navbar-nav navbar-right">
                            <?php 
                                  if(filter_input(INPUT_COOKIE,'username')) {?>
                                      <li class="active"> <a href="#">Welcome <?=filter_input(INPUT_COOKIE,'username'); ?></a> </li>
                                      <li class="active"> <a href="#" data-toggle="modal" data-target="#logoutModal">Logout!</a>  </li>
                                  <?php } else { ?>    
                                                <li class="active"> <a href="#" data-toggle="modal" data-target="#myModal">Login</a> </li>
                                                <li class="active"> <a href="view/sign_in.php">Sign in!</a>  </li>
                                         <?php } ?>
                            <li> <a href="#">Contacts</a> </li></ul> </div></div></div><div class="cover-image"></div><div class="container"> <div class="row"> <div class="col-md-12 text-center"> <h1>Talk</h1> <p>We're better than Wordpress</p><br><br><a class="btn btn-lg btn-default">Click me</a> 
                    </div></div></div></div>
        <!-- start modal login form -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header jumbotron">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Talk Login</h4>
                </div>
                <div class="modal-body">
                  <?php require_once 'view/login.php';?>

                </div>
                  <div class="modal-footer">
                      Copyright&COPY; Name Last name <?=date("Y");?>
                  </div> 
              </div>
            </div>
        </div>
        <!-- end modal login form ->
        <!-- being confirm logout modal -->
             <div class="modal fade" id="logoutModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header jumbotron">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Talk Logout</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                    <p><button type="button" class="btn btn-lg btn-primary" onclick="window.location='controller/logout.php'">Logout</button></p>
            
                </div>
                  <div class="modal-footer">
                      Copyright&COPY; Name Last name <?=date("Y");?>
                  </div> 
              </div>
            </div>
        </div>
        <!-- end of confirm logout modal -->
    
    
    
    
    </body></html>