<?php 
/**
 * All'interno di questa classe sidefiniscono i metodi necessari alla visualizzazione delle voci
 * di menù per la finestra di amministrazione di un utente ordinario saranno quindi disponibili 
 * le seguenti funzionalità
 * <ul>
 * <li>Modifica informazioni profilo</li>
 * <li>Gestione dei post, nello specifico sarà possibile gestire la:
 * <ul>
 * 	<li>Creazione</li>
 * 	<li>Cancellazione</li>
 * 	<li>Modifica</li>
 *</ul>
 *</li>
 *<li>Logout</li>
 *</ul>
 * @author Corso Programmazione
 *
 */
class UserToolbar {
	
	function drawLogoutButton() {?>
		<li><a href="../controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
		<?php 
	}

	/*
	function  drawShowProfileButton($links) { ?>	
		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <?php 
        foreach ($links as $current_link) {?>
          <li><a href="<?=$current_link['url'];?>"><?=$current_link['label']?></a></li>
          <?php } ?>
        </ul>
      </li>		
	<?php } 
	
	*/
	
	/**
	 * 
	 * @param type $buttonLabel è l'etichetta che sarà mostrata all'interno della toolbar
	 * @param type $links è un vettore di vettori organizzato secondo la struttura seguente
	 * posizione=> {label,url} in cui label rappresenta l'etichetta che sarà utilizzata all'interno del menù a discesa 
	 * ed url è il link alla pagina che si dovrà visulizzare
	 * @example drawDropDownButton("Posts", array(array("label"=>"create","url"=>"new_post.php"),
	 * 								array("label"=>"delete","url"=>"delete_post.php")));
	 */
	function  drawDropDownButton($buttonLabel,$links) { ?>
			<li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$buttonLabel;?>
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	        <?php 
	        foreach ($links as $link_label=>$current_link) {?>
	          <li><a href="<?=$current_link;?>"><?=$link_label;?></a></li>
	          <?php } ?>
	        </ul>
	      </li>		
		<?php } 
	
}

?>