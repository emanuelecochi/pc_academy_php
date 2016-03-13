<?php 
require_once '../shared/header.php';
?>
<script>
$(document).ready(function () {
	$('#login_form').submit(function(evt) {
		evt.preventDefault();
		if($('#g-recaptcha-response').val()=='')
			alert("Seleziona il captcha");
		else {
			$.ajax({ // richiesta asincrona, rimangono nella pagina dopo aver inviato i dati della form 
	 			url:'../controller/login.php',
	 			method:'POST',
	 			data:$('#credentials_form').serialize(), //spedizione dei dati dopo essere serializzati chiave->valore
	 			success:function(data) { //data contiene i dati inviati da add_post
		 			if(data=="ok")
		 				window.location="./view/homepage.php";
		 			else alert(data);
	 			},
	 			error:function(request, status, error) {
					alert(request.responseText);
		 	}
 		});
		}
	});
});
</script>
</head>
<body>
		<div class="container">
            <div class="jumbotron">
                <h1><span class="glyphicon glyphicon-user"> Login Administration Panel</span></h1>
            </div>
        </div>
        <div class="container">
        <form id="login_form">
        	<p class="col-sm-offset-4>
        		<label for="usn">Username:</label>
        		<input type="text" name="username" id="usn" required>
        	</p>
        	<p class="col-sm-offset-4>
        		<label for="pwd">Password:</label>
        		<input type="password" name="password" id="pwd" required>
        	</p>
        	<p class="col-sm-offset-4 btn-group btn-group-lg>
        		<button type="submit" class="btn btn-primary">Login</button>
        		<button type="reset" class="btn btn-primary">Cancel</button>
        	</p>
        	<p>
        	<div class="clo-sm-offset-4 g-recaptcha" data-sitekey="6LfUgxgTAAAAAK93MWLJ2KmRiexquUUpx7oy_4LI"></div>
        	</p>
        </form>
        </div>
</body>
</html>