<?php

namespace Ima\Users;

use DateTime;
use Finanzas\Controller\ClienteController;
use Ima\Data\Object;
use Ima\Data\ObjectInterface;
use Ima\Routing\Routing;
use JsonSerializable;

/**
 * User
 * @author lpena
 */
class User extends Object implements ObjectInterface,  JsonSerializable {
    
    private $username;
    private $email;
    private $firstname;
    private $middlename;
    private $lastname;
    /**
     *
     * @var DateTime
     */
    private $birthday;
    private $password;    
    private $type;
    private $active;
    private $deleted;
    /**
     *
     * @var DateTime
     */
    private $creationDate;
    /**
     *
     * @var DateTime
     */
    private $deletedDate;
    
    public function __construct($username="",$password="",$type="") {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
    }
    /**
     * 
     * @param \Ima\Users\UserMysql $mysqlObject
     * @return \Ima\Users\User
     */
    public function fromMysql($mysqlObject) {
        if($mysqlObject!=NULL) {
            $this->active = $mysqlObject->active;
            $this->birthday = new DateTime($mysqlObject->birthday);
            $this->creationDate = new DateTime($mysqlObject->creationDate);
            $this->deleted = $mysqlObject->deleted;
            $this->deletedDate = new DateTime($mysqlObject->deletedDate);
            $this->email = $mysqlObject->email;
            $this->firstname = $mysqlObject->firstname;
            $this->lastname = $mysqlObject->lastname;
            $this->middlename = $mysqlObject->middlename;
            $this->password = $mysqlObject->password;
            $this->type = $mysqlObject->type;
            $this->username = $mysqlObject->username;
            $this->id = $mysqlObject->id;
        }
        return $this;
    }
    /**
     * 
     * @return \Ima\Users\UserMysql
     */
    public function toMysql() {
        $mysqlObject = new \Ima\Users\UserMysql();
        $mysqlObject->active = $this->active;
        $mysqlObject->birthday = ($this->birthday!=NULL)? $this->birthday->format("Y-m-d H:i:s"):"";
        $mysqlObject->creationDate = ($this->creationDate!=NULL)? $this->creationDate->format("Y-m-d H:i:s"):"";
        $mysqlObject->deleted = $this->deleted;
        $mysqlObject->deletedDate = ($this->deletedDate!=NULL)? $this->deletedDate->format("Y-m-d H:i:s"):"";
        $mysqlObject->email = $this->email;
        $mysqlObject->firstname = $this->firstname;
        $mysqlObject->lastname = $this->lastname;
        $mysqlObject->middlename = $this->middlename;
        $mysqlObject->password = $this->password;
        $mysqlObject->type = $this->type;
        $mysqlObject->username = $this->username;
        $mysqlObject->id = $this->id;
        return $mysqlObject;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getMiddlename() {
        return $this->middlename;
    }

    public function getLastname() {
        return $this->lastname;
    }
    /**
     * 
     * @return DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type;
    }
    
    public function getTypeName() {
        switch($this->type) {
            case \Ima\Users\UserMysql::USER:
                return "User";
                break;  
            case \Ima\Users\UserMysql::ADMIN:
                return "Admin";
                break;  
            case \Ima\Users\UserMysql::MASTER:
                return "Master";
                break; 
            default :
                return "Other";                
        }
    }

    public function getActive() {
        return $this->active;
    }

    public function getDeleted() {
        return $this->deleted;
    }
    /**
     * 
     * @return DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }
    /**
     * 
     * @return DateTime
     */
    public function getDeletedDate() {
        return $this->deletedDate;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setMiddlename($middlename) {
        $this->middlename = $middlename;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setBirthday(DateTime $birthday) {
        $this->birthday = $birthday;
    }

    public function setPassword($password,$encode=true) {                
        $this->password = ($encode)? md5($password):$password;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setDeletedDate(DateTime $deletedDate) {
        $this->deletedDate = $deletedDate;
    }
    
    public function getFullNameAndUserName() {        
        return (($this->getFirstname()!="")? $this->getFirstname()." ":"") . (($this->getMiddlename()!="")? $this->getMiddlename()." ":"") . (($this->getLastname()!="")? $this->getLastname()." ":"")."(".$this->getUsername().")";
    }
    
    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'active' => $this->getActive(),
            'creationDate' => $this->getCreationDate()->format('d-M-Y'),
            'deleted' => $this->getDeleted(),
            'deletedDate' => $this->getDeletedDate()->format('d-M-Y'),
            'email' => $this->getEmail(),
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'middlename' => $this->getMiddlename(),
            'type' => $this->getType(),
            'username'=> $this->getUsername()
        ];
    }

}
