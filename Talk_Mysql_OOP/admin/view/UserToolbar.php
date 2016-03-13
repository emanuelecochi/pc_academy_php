<?php 
/**
 * All'interno di questa classe sidefiniscono i metodi necessari alla visualizzazione delle voci
 * di men� per la finestra di amministrazione di un utente ordinario saranno quindi disponibili 
 * le seguenti funzionalit�
 * <ul>
 * <li>Modifica informazioni profilo</li>
 * <li>Gestione dei post, nello specifico sar� possibile gestire la:
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
	 * @param type $buttonLabel � l'etichetta che sar� mostrata all'interno della toolbar
	 * @param type $links � un vettore di vettori organizzato secondo la struttura seguente
	 * posizione=> {label,url} in cui label rappresenta l'etichetta che sar� utilizzata all'interno del men� a discesa 
	 * ed url � il link alla pagina che si dovr� visulizzare
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