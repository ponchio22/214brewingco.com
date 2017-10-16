<?php

namespace Ima\Users;

use Ima\Data\SingletonInterface;
use Ima\Date\MyDate;
use Ima\MySql\MySqlTable;
use Ima\Users\UserMysql;
use Ima\Users\UsersManagment;

class AuthenticationManagment extends MySqlTable implements SingletonInterface {
    
    private $usersManagment;
    
    const NO_ERROR = 0;
    const ERROR_USER_NOT_ACTIVE = 1;    
    const ERROR_USER_NOT_FOUND = 2;
    const ERROR_WRONG_PASSWORD = 3;
    const ERROR_DB_ERROR = 4;
    
    private static $instance;
    /**
     * 
     * @return \Ima\Users\AuthenticationManagment
     */
    public static function getInstance() {
        if(\Ima\Users\AuthenticationManagment::$instance==NULL) \Ima\Users\AuthenticationManagment::$instance = new \Ima\Users\AuthenticationManagment ();
        return \Ima\Users\AuthenticationManagment::$instance;
    }
    
    /**
     * Constructor
     */
    public function __construct() {        
        parent::__construct("sessions");        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->usersManagment = UsersManagment::getInstance();
        $this->addColumn("username", "VARCHAR(12)");
        $this->addColumn("sessionToken", "VARCHAR(32)");
        if(!$this->exists()) {
            $this->create();
        }
    }
    
    /**
     * Try to log into session the username provided
     * @param string $username
     * @param string $password
     * @return int Static constant of the result
     */
    public function login($username,$password) {
        if($this->usersManagment->getUserExists($username)) {
            $user = $this->usersManagment->getUserMysql($username);            
            if($user != null && $user->active==1) {
                if($user->password==md5($password)) {
                    if(!$this->connected) $this->connect();
                    $sessionToken = md5($_SERVER['HTTP_USER_AGENT'] . MyDate::getDate());
                    $query = "SELECT COUNT(*) FROM $this->tableName WHERE username='$user->username'";
                    $result = mysql_query($query);
                    $data = mysql_fetch_assoc($result);
                    if($data["COUNT(*)"] > 0) {
                        $query = "UPDATE $this->tableName SET sessionToken='$sessionToken' WHERE username='$user->username'";
                    } else {
                        $query = "INSERT INTO $this->tableName (username,sessionToken)VALUES('$user->username','$sessionToken')";
                    }
                    $_SESSION["sessionToken"] = $sessionToken;
                    $result = mysql_query($query);
                    if($result) {
                        return \Ima\Users\AuthenticationManagment::NO_ERROR;
                    } else {
                        return \Ima\Users\AuthenticationManagment::ERROR_DB_ERROR;
                    }
                } else {
                    return \Ima\Users\AuthenticationManagment::ERROR_WRONG_PASSWORD;
                }
            } else {
                return \Ima\Users\AuthenticationManagment::ERROR_USER_NOT_ACTIVE;
            }
        } else {
            return \Ima\Users\AuthenticationManagment::ERROR_USER_NOT_FOUND;
        }        
    }
    /**
     * Get the user currently in session
     * @return UserMysql
     */
    public function getCurrentSessionUser() {
        $user = NULL;        
        $sessionToken = @$_SESSION["sessionToken"];
        if($sessionToken!="") {
            $query = "SELECT username FROM $this->tableName WHERE sessionToken='$sessionToken'";
            $result = mysql_query($query);
            if($result) {
                $data = mysql_fetch_assoc($result);
                $username = $data["username"];
                $user = $this->usersManagment->getUserMysql($username);
                return $user;
            }
        }
        return $user;
    }
    
    /**
     * Logs out the user from the session
     * @return boolean
     */
    public function logout() {             
        $sessionToken = (isset($_SESSION["sessionToken"]))? $_SESSION["sessionToken"]:"";
        if($sessionToken!="") {
            $query = "SELECT username FROM $this->tableName WHERE sessionToken='$sessionToken'";
            $result = mysql_query($query);
            if($result) {
                $data = mysql_fetch_assoc($result);
                $username = $data["username"];
                $query = "DELETE FROM $this->tableName WHERE username='$username'";
                $result = mysql_query($query);
                unset($_SESSION["sessionToken"]);
                return true;
            }
        }
        return true;
    }
}
