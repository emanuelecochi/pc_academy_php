<?php 
session_start();
session_destroy();
require_once '../shared/header.php';
?>
<script>
	$(document).ready(function(){
		alert("Logout completato con successo");
		window.location='../index.php';
	});
</script>
</head>
<body></body>
</html>