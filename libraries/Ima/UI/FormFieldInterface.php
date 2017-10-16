<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\UI;

/**
 * Form field Interface
 * @author LuisAlfonso
 */
interface FormFieldInterface {
    
    const INPUT_TEXT = 'input_text_form_field';
    
    const SELECT = 'select_form_field';
    
    const DATE = 'date_form_field';
    
    const PASSWORD = 'password_form_field';
    
    const MULTIPLE_SELECT = 'multiple_select_form_field';
    
    const BUTTON = 'button_form_field';
    
    const SUBMIT = 'submit_form_field';
    
    const STATIC_TEXT = 'static_text_form_field';
    
    const CURRENCY = 'currency_form_field';
    
    const CUSTOM = 'custom_form_field';
    
    const CHECKBOX = 'checkbox_form_field';
    
    const TEXT_AREA = 'textarea_form_field';
    
}