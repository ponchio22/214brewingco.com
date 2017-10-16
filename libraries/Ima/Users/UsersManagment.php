<?php
namespace Ima\Users;

use Ima\Data\SingletonInterface;
use Ima\Date\MyDate;
use Ima\MySql\MySqlObject;
use Ima\MySql\MySqlTable;
use Ima\MySql\MySqlTableInterface;
use Ima\Users\UserMysql;

class UsersManagment extends MySqlTable implements MySqlTableInterface,  SingletonInterface {
    
    public static $userChecked = false;
    private static $userExists = false;    
    private $userData = NULL;
    private $users = NULL;
    private static $instance;
    /**
     * 
     * @return \Ima\Users\UsersManagment
     */
    public static function getInstance() {
        if(\Ima\Users\UsersManagment::$instance==NULL) \Ima\Users\UsersManagment::$instance = new \Ima\Users\UsersManagment();
        return UsersManagment::$instance;
    }
    /**
     * Constructor
     */
    protected function __construct() {
        parent::__construct("users");
        $this->buildStructure();
        $this->createIfDoesntExists();
        $user = new UserMysql("ponchio22", "ponchio22", UserMysql::MASTER);
        if(!$this->getUserExists($user->username)) {            
            $this->addUserMysql($user);
            $user = $this->getUser($user->username);
            $this->ActivateUser($user->toMysql());
        }
    }
    
    public function buildStructure() {
        $this->addColumn("username", "VARCHAR(30)");
        $this->addColumn("email", "VARCHAR(64)");
        $this->addColumn("firstname", "VARCHAR(64)");
        $this->addColumn("middlename", "VARCHAR(64)");
        $this->addColumn("lastname", "VARCHAR(64)");
        $this->addColumn("birthday", "DATETIME");
        $this->addColumn("password", "VARCHAR(32)");       
        $this->addColumn("type", "VARCHAR(20)");
        $this->addColumn("active", "INTEGER(1)");
        $this->addColumn("deleted", "INTEGER(1)");
        $this->addColumn("creationDate", "DATETIME");
        $this->addColumn("deletedDate", "DATETIME");
    }
        
    /**
     * Adds a new user to the database
     * @param \Ima\Users\UserMysql $user
     * @return boolean
     */
    public function addUserMysql($user) {
        if(!$this->getUserExists($user->username,true)) {            
            $creationdate = MyDate::getDate();                    
            $query = "INSERT INTO $this->tableName (username,email,firstname,middlename,lastname,birthday,password,type,active,deleted,creationDate)VALUES('$user->username','$user->email','$user->firstname','$user->middlename','$user->lastname','$user->birthday','$user->password','$user->type',0,0,'$creationdate')";                    
            $result = $this->query($query);
            return ($result);
        } else {            
            return false;
        }
    }
    /**
     * 
     * @param \Ima\Users\User $user
     * @return type
     */
    public function addUser(\Ima\Users\User $user) {        
        return $this->addUserMysql($user->toMysql());
    }
    
    /**
     * Gets the user based on the provided username
     * @param string $username
     * @return \Ima\Users\UserMysql
     */
    public function getUserMysql($username,$force=false) {
        if($this->userData == NULL || $force== true) {
            if($this->getUserExists($username,true)) {
                $query = "SELECT *  FROM $this->tableName WHERE username='$username'";
                $result = $this->query($query);
                if($result) {
                    $data = mysql_fetch_assoc($result);
                    if(is_array($data)) {
                    $user = $this->associateObject(new UserMysql(), $data);
                    $this->userData = $user;
                    }
                }
            }
        }
        return $this->userData;
    }
    /**
     * Gets the user based on the username
     * @param type $username
     * @return type
     */
    public function getUser($username) {
        $usermysql = $this->getUserMysql($username);
        if($usermysql!=NULL) {
            return (new \Ima\Users\User())->fromMysql($usermysql);
        }
        return NULL;
    }
    
    /**
     * Updates the user information
     * @param \Ima\Users\UserMysql $user
     * @return boolean
     */
    public function updateUser($user,$force=false) {
        if($this->getUserExists($user->username,$force)) {
            $query = "UPDATE $this->tableName SET username='$user->username',email='$user->email',firstname='$user->firstname',middlename='$user->middlename',lastname='$user->lastname',birthday='$user->birthday',password='$user->password',type='$user->type',active='$user->active',deleted='$user->deleted' WHERE id='$user->id'";            
            $result = $this->query($query);
            return ($result);
        } else {
            return false;
        }
    }
    /**
     * Tells if a specified username exists
     * @param string $username
     * @return boolean
     */
    public function getUserExists($username,$force=false){        
        if(!\Ima\Users\UsersManagment::$userChecked || $force){            
            $query = "SELECT COUNT(*) FROM $this->tableName WHERE username='$username'";
            $result = $this->query($query);
            if($result) {
                $data = mysql_fetch_assoc($result);
                \Ima\Users\UsersManagment::$userExists = ($data['COUNT(*)']>0);
            } else {
                \Ima\Users\UsersManagment::$userExists = false;
            }
            \Ima\Users\UsersManagment::$userChecked = true;
        }
        return \Ima\Users\UsersManagment::$userExists;
    }
    
    /**
     * Activates the supplied user
     * @param \Ima\Users\UserMysql $user
     * @return boolean
     */
    public function ActivateUser($user) {
        if($user->active == 0) {
            $user->active = 1;
            return $this->updateUser($user,true);
        } else {
            return true;
        }
    }
    
    /**
     * Deletes the user
     * @param \Ima\Users\UserMysql $user
     * @return boolean
     */
    public function DeleteUser($user) {
        if($user->deleted==0) {
            $query = "DELETE FROM $this->tableName WHERE username='$user->username'";
            $result = $this->query($query);
            return ($result);
        } else {
            return true;
        }
    }
    /**
     * Get all the users in the database
     * @param type $force
     * @return type
     */
    public function all($force=false) {
        if($this->users ==NULL) {
            $usersmysql = parent::all(new UserMysql());
            $users = array();
            /* @var $usermysql UserMysql */        
            foreach($usersmysql as $usermysql) {
                array_push($users, (new \Ima\Users\User())->fromMysql($usermysql));
            }
            $this->users = $users;
        }
        return ($this->users==NULL)?array():$this->users;
    }
    /**
     * Get the user object by id
     * @param string $id
     * @return \Ima\Users\User
     */
    public function get($id) {
        return (new \Ima\Users\User())->fromMysql(parent::get($id, new UserMysql()));
    }
    /**
     * Old Get Function
     * @param type $id
     * @param MySqlObject $object
     */
    public function getMysql($id, MySqlObject $object) {
        return parent::get($id, $object);
    }
}