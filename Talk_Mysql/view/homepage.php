<?php 
session_start();
if(!isset($_SESSION['nickname']))
	header("Location:../index.php");
require_once '../shared/header.php';
?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({
// 	  selector: 'textarea',
// 	  height: 500,
// 	  theme: 'modern',
// 	  plugins: [
// 	    'advlist autolink lists link image charmap hr anchor pagebreak',
// 	    'searchreplace wordcount visualblocks visualchars code fullscreen',
// 	    'insertdatetime media nonbreaking save table contextmenu directionality',
// 	    'emoticons template paste textcolor colorpicker textpattern imagetools'
// 	  ],
// 	  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media | forecolor backcolor emoticons',
// 	  image_advtab: true,
// 	  templates: [
// 	    { title: 'Test template 1', content: 'Test 1' },
// 	    { title: 'Test template 2', content: 'Test 2' }
// 	  ],
// 	  content_css: [
// 	    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
// 	    '//www.tinymce.com/css/codepen.min.css'
// 	  ]
// 	 });
// </script>
<script>
	 $(document).ready(function() {
		 $('#publish').submit(function(evt) {
			 evt.preventDefault(); //impedisce l'invio dei dati dalla form
			 $.ajax({ // richiesta asincrona, rimangono nella pagina dopo aver inviato i dati della form 
				 		url:'../controller/add_post.php',
				 		method:'POST',
				 		data:$('#publish').serialize(), //spedizione dei dati dopo essere serializzati chiave->valore
				 		success:function(data) { //data contiene i dati inviati da add_post
					 		if(data!=="error") {
						 		alert(data);
					 			$('#my_posts').append($('#titolo').val()+"<br/>");
					 			$('#publish')[0].reset(); //[0] indica resettare tutta la form
					 		}
				 		},
				 		error:function(data) {
					 		alert("Errore durante la fase di salvataggio del post");
				 		}
			 });
		 });
	 });
</script>
<title>Talk about yourself</title>
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bentornato <?= $_SESSION['nickname'];?></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
   	  <li><a href="./visualizza_post.php"><span class="glyphicon glyphicon-list-alt"></span> Visualizza posts</a></li>
      <li><a href="../admin/index.php"><span class="glyphicon glyphicon-user"></span> Modifica Post</a></li>
      <li><a href="../controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	<div class="container-fluid">
		<div class="jumbotron">
		<h1>Talk about yourself</h1>
		</div>
	</div>
	<div class="row">
	<div class="col-sm-9">
		<form  action="../controller/add_post.php" method="post" id='publish'>
		<p>
		<!-- nome post -->
		<label for="titolo">Titolo</label>
		<input type="text" name="titolo" id="titolo" placeholder="Digita il titolo del tuo post" required>
		</p>
		<p>
		<!-- categoria -->
		<label for="categoria">Categoria</label>
		<input type="text" name="categoria" id="categoria" placeholder="Digita il nome della categoria" required>
		</p>
		<p>
		<!-- contenuto -->
		<label for="contenuto">Testo post:</label>
		<textarea name="contenuto" rows="10" cols="40"></textarea>
		</p>		
		<!-- button group -->
		<p class="btn-group btn-group-lg" role="group" ><!-- creo un button group -->
                        <button type="submit" class="btn btn-primary"><!--pulsante con sfondo blu arrotondato-->
                            <span class="glyphicon glyphicon-pencil">&nbsp;</span>Publish!</button> <!-- glifo con l'immagine di un utente stilizzato -->
                        <button type="reset" class="btn btn-primary">
                            <span class="glyphicon glyphicon-trash">&nbsp;</span>
                            Cancel!</button>
         </p>
		</form>
	</div>
		<div class="col-sm-3" id='my_posts'>
			<h4>Post pubblicati</h4>
		</div>
	</div>
</body>