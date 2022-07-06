<?php
namespace PHPMVC\LIB;

/**
 * Description of InputFilter
 *
 * @author emadr
 */
trait InputFilter {
    
    
    public function FilterInt($input){
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

    }
    public function FilterFLOAT($input){
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT , FILTER_FLAG_ALLOW_FRACTION);
    }
    public function FilterSTR($input){
        return htmlentities(strip_tags($input),ENT_QUOTES , 'UTF-8');
    }
}  
