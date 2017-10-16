<?php

namespace Ima\Data;

/**
 * NumberFormat
 * @author lpena
 */
class NumberFormat {
    
    public static function money($value,$displayComma=false) {
        return number_format($value, 2, ".", ($displayComma)? ",":"");
    }
}
