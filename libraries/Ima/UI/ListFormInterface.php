<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\UI;

/**
 *
 * @author LuisAlfonso
 */
interface ListFormInterface {
    
    public function setFilters($filters);
    public function setOffset($offset);
    public function setLimit($limit);
    public function getFilters();
    public function getOffset();
    public function getLimit();
    
}
