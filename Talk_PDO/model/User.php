<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Corso Programmazione
 */
class User {
    private $username;
    private $nickname;
    private $avatar;
    private $password;
    public function __construct($usn,$nick,$avt,$pwd="") {
        $this->username = $usn;
        $this->nickname = $nick;
        $this->avatar = $avt;
        $this->password = $pwd;
    }
    public function __toString() {
        $div_profile = <<<EOD
                <div><p>Username:$this->username</p>
                <p>Nickname:$this->nickname</p>
                <p>Avatar:<img src='$this->avatar' class='img-responsive'/></p>
                </div>
EOD;
        return $div_profile;
    }
}
