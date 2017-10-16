<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\MySql;

class MySqlTableColumn {
    
    public $columnName;
    public $columnDefinition;
    
    public function __construct($columnName,$columnDefinition) {
        $this->columnName = $columnName;
        $this->columnDefinition = $columnDefinition;
    }
}