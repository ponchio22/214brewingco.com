<?php

namespace Ima\Forms;

use Administration\Controls\GuardarButton;
use Administration\Controls\RegresarButton;
use Administration\Data\Template\EmptyForm;
use Administration\Data\Template\SimpleFormInputTextField;
use Administration\Data\Template\SimpleFormPasswordField;

/**
 * MysqlConfigForm
 * @author lpena
 */
class MysqlConfigForm extends EmptyForm {
    
    private $databaseHost;
    private $databaseName;
    private $databaseUser;
    private $databasePassword;
    private $guardarButton;
    private $regresarButton;
    
    public function __construct($name) {
        parent::__construct($name);
        $this->databaseHost = new SimpleFormInputTextField("database_host", "database_host", "Host","","e.g. localhost");
        $this->databaseName = new SimpleFormInputTextField("database_name", "database_name", "Name","","Enter the name of the database");
        $this->databaseUser = new SimpleFormInputTextField("database_user", "database_user", "User","","Username you use to access the database");
        $this->databasePassword = new SimpleFormPasswordField("database_password", "database_password", "Password");
        $this->guardarButton = (new GuardarButton("guardar", "guardar"))->setPrimary(true);
        $this->regresarButton = (new RegresarButton("regresar", "regresar"));
        $this->addItem($this->databaseHost)
                ->addItem($this->databaseName)
                ->addItem($this->databaseUser)
                ->addItem($this->databasePassword)
                ->addItem($this->guardarButton)
                ->addItem($this->regresarButton);
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getDatabaseHost() {
        return $this->databaseHost;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getDatabaseName() {
        return $this->databaseName;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getDatabaseUser() {
        return $this->databaseUser;
    }
    /**
     * 
     * @return SimpleFormPasswordField
     */
    public function getDatabasePassword() {
        return $this->databasePassword;
    }

    public function getGuardarButton() {
        return $this->guardarButton;
    }


}
