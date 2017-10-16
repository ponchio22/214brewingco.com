<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\MySql;

use Exception;
use Ima\Controller\ImaController;
use Ima\Routing\Routing;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of mySqlConnection
 *
 * @author lpena
 */
class MySqlConnection {
    
    protected $server;
    protected $database;
    protected $username;
    protected $password;
    protected $link;
    protected $connected = false;    
    
    //put your code here
    public function connect(){
        $this->loadParameters();
        $this->link = mysql_connect($this->server, $this->username,$this->password);       
        $this->connected = mysql_select_db($this->database);              
        return $this->link;        
    }
    
    public function loadParameters() {
        $yaml = new Yaml();        
        try {
            $filename = $this->getConfigFilename();            
            if(file_exists($filename)) {
            $outputyaml = $yaml->parse(file_get_contents($filename));
            $this->server = $outputyaml['parameters']['database_host'];
            $this->database = $outputyaml['parameters']['database_name'];
            $this->username = $outputyaml['parameters']['database_user'];
            $this->password = $outputyaml['parameters']['database_password'];            
            } else {
                throw new Exception('File Not Found');
            }
        } catch(Exception $e) {
            $newURL = Routing::getPath(ImaController::MYSQL_CONFIGURATION,[],  Routing::attachCurrentUrl());
            header('Location: '. $newURL);
            die();
        }
        return $this;
    }
    
    public function close() {
        if($this->connected) 
        mysql_close($this->link);
    }
    
    public function getDatabase() {
        return $this->database;
    }
    /**
     * Gets the configuration filename
     * @return type
     */
    public function getConfigFilename() {
        return Routing::getRoot() . 'configuration/mysql.yml'; 
    }

    public function getServer() {
        return $this->server;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }



}
