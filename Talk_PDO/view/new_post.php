<?php
if(filter_input(INPUT_COOKIE, 'username')===FALSE)
        header("Location:../index.php");
require_once 'header.php';
?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 
  <script>tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap  hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars  fullscreen',
    'insertdatetime media nonbreaking table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image| media | forecolor backcolor emoticons',
   image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
  
  </script>
  <script>
   $(document).ready(function() {
       $('#publish').submit(function(evt) {
           evt.preventDefault();
           tinyMCE.get("contenuto").save();
               $.ajax({
                    url:'../controller/add_post.php',
                    type:'post',
                    data:new FormData(this),
                    processData:false,
                    contentType:false,  
                   success:function(data) {
                       if(data!=='error') {
                          $('#publish')[0].reset();
                    } else {
                        alert("Errore durante la fase di salvataggio del post");
                    }
                    },
                    error:function(data) {
                        alert(data);
                    }
               
           });
       });
       
   });
  </script>
<title>Talk about yourself <?=$_COOKIE['username'];?></title>
</head>
<body>
  
    <div class="container">
        <div class="jumbotron">
            <h1>New Post</h1>
        </div>    
    </div> 
    <div class="container">
    <div >
        <form id='publish'>
            <p>
                <!-- nome post -->
                <label for="titolo">Titolo</label>
                <input type="text" name="titolo" id="titolo" placeholder="Digita il titolo del tuo post"
                       required>
            </p>
            <p>
                <!-- categoria -->
                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" name="categoria" placeholder="Digita il nome della categoria">
            </p>
            <p>
                <label for="copertina">Immagine di copertina</label>
                <input type="file" name="copertina" id="copertina" pattern="^(.+)\.(jpg|png|svg|bmp)$" required>
            </p>
            <p>
                <!-- contenuto -->
                <span>
                <label for="conteuto">Testo post:</label>
                <textarea name="contenuto" id="contenuto" rows="10" cols="40"></textarea>
                </span>
                </p>
            <p>
               <!-- costo -->
               <span>
                   <label for="costo">Valore d'acquisto</label>
                   <input type='text' patter='\d+(\.(\d+))?' value='0.0' name='costo' id='costo'>
               </span>
            </p>    
            <p class="btn-group btn-group-lg" role="group" ><!-- creo un button group -->
                        <button type="submit" class="btn btn-primary"><!--pulsante con sfondo blu arrotondato-->
                            <span class="glyphicon glyphicon-pencil">&nbsp;</span>Publish!</button> <!-- glifo con l'immagine di un utente stilizzato -->
                        <button type="reset" class="btn btn-primary">
                            <span class="glyphicon glyphicon-trash">&nbsp;</span>
                            Cancel!</button>
            </p>
        </form> 
    </div>
           
    </div>    
</body>

