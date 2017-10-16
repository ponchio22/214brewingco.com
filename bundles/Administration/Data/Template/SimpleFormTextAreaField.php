<?php
namespace Administration\Data\Template;

use Ima\UI\FormField;
/**
 * Description of SimpleFormTextAreaField
 *
 * @author lpena
 */
class SimpleFormTextAreaField extends FormField {
    
    private $rows = 3;
    
    public function __construct($id, $name, $label, $value = '', $rows=3,$visible = true, $htmlFile = '') {
        parent::__construct($id, $name, $label, FormField::TEXT_AREA, $value, '', $visible, $htmlFile);
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormTextAreaField.php';
        $this->rows = $rows;
    }
    /**
     * 
     * @return int
     */
    public function getRows() {
        return $this->rows;
    }
    /**
     * 
     * @param int $rows
     */
    public function setRows($rows) {
        $this->rows = $rows;
    }
}
