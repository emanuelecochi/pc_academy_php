<?php
require_once '../model/PostManager.php';
require_once '../shared/PDO_Connector.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gui_Builder
 *
 * @author Corso Programmazione
 */
class Gui_Builder {
    private $dbh;
    public function __construct() {
        $this->dbh = PDO_Connector::get_connection();
    }
    public function build_post_area() {
        $pm = new PostManager($this->dbh);
        $last_posts = $pm->select_last_posts();
        foreach ($last_posts as $index => $post) {
            echo $post->build_row($index%2==0?'':'pull-right');
        }
        
    }
}
