<?php
namespace Ima\UI;

use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @author lpena
 */
interface FormInterface {
    /**
     * Validates the form fields
     * return boolean
     */
    public function validate();
    /**
     * Updates the object data from the fields values
     */
    public function updateObjectDataFromFields();
}
