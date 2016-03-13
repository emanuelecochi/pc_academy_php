<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Corso Programmazione
 */
class Post {
   private $id_post;
   private $id_autore;
   private $titolo;
   private $testo_post;
   private $categoria;
   private $immagine_copertina;
   private $costo;
   public function __construct($idp,$ida,$tit,$text,$cat,$imm,$cst) {
       $this->id_post = $idp;
       $this->id_autore = $ida;
       $this->testo_post = $text;
       $this->titolo = strtoupper($tit);
       $this->categoria = $cat;
       $this->immagine_copertina = $imm;
       $this->costo = $cst;
   }
   public function __toString() {
       $output=<<<OUT
               
               <div class='container'>
                 <div class='jumbotron'>
                 <h1>$this->titolo</h1>
                 <h4><a href='show_all_article_into_catagory.php?cat=$this->categoria'>$this->categoria</a></h2>
                 </div>
                 <div class='row'>
                    <div class='col-sm-6 img-responsive'>
                    <img src='images/$this->immagine_copertina' alt='Immagine di coperti per articolo $this->titolo'/>
                    </div>
                </div>
                 <div class='row'>
                     $this->testo_post;
                 </div>
                 <div class='row col-sm-offest-8'>
                   <a href='show_all_author_articles.php?id_autore=$this->id_autore'>Leggi articoli di $this->id_autore</a>
                 </div>
               </div>
OUT;
      return $output; 
   }
   public function build_row($offset='') {
       //strip_tags($this->testo_post,"<b>,<h1>,<h2>,<h3>,<p>")
       $abstract = substr($this->testo_post, 0, 300);
       $remainder = substr($this->testo_post,301); 
       
       if($this->costo>0) {
            $pay_or_free=<<<PAY
                   <div>
                   L'articolo non è gratuito, per visualizzarlo devi acquistarlo 
                   <h3>Costo: &euro; $this->costo</h3>
                   </div>
                    <form id="add_to_cart">
                        <input type='hidden' name='id_articolo' value='$this->id_post'>
                       <button type="submit" class="btn btn-success">&euro; Acquista &euro;</button>
                    </form>
PAY;
       } else {
   $pay_or_free = <<<FREE
               <div id="rest$this->id_post" class="collapse">
                        $remainder
                     </div>
                      <button id="readmore" type="button" class="btn btn-info" data-toggle="collapse" data-target="#rest$this->id_post">Read more...</button>
FREE;
   }
                   
       $output=<<<OUTPUT
               <div class="section">
                    <div class="container">
                         <div class="row">
                              <div class="col-sm-3 $offset">
                               <img src='$this->immagine_copertina' alt='$this->immagine_copertina' class='img-responsive' />
                              </div>
                              <div class="col-sm-9">
                                 <h2>$this->titolo</h2>
                                 <h4>Categoria:$this->categoria</h4>
                                 <p>$abstract
                                   $pay_or_free
                                </p>
                              </div>
                         </div>
                    </div>
               </div>
OUTPUT;
       return $output;
   }
}
