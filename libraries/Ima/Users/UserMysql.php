<?php

namespace Ima\Users;

use Ima\MySql\MySqlObject;

class UserMysql extends MySqlObject {
    
    const USER = 1;
    const ADMIN = 2;
    const MASTER = 3;
    
    public $username;
    public $email;
    public $firstname;
    public $middlename;
    public $lastname;
    public $birthday;
    public $password;    
    public $type;
    public $active;
    public $deleted;
    public $creationDate;
    public $deletedDate;
    
    public function __construct($username='',$password='',$type='') {
        $this->username = $username;
        $this->password = md5($password);
        $this->type = $type;
    }
    
    public function setPassword($password) {
        $this->password = md5($password);
    }

}