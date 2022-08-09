<?php

namespace PHPMVC\LIB;

trait Validate {
private $_RexPatterns = [
        'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'           => '/^[0-9]+$/',
        'float'         => '/^[0-9]+\.[0-9]+$/',
        'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphaNum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'vdate'         => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'         => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
    ];

    public function num($val){    
        return (bool) preg_match($this->_RexPatterns['num'], $val);
    }
    public function int($val){    
        return (bool) preg_match($this->_RexPatterns['int'], $val);
    }
    public function float($val){    
        return (bool) preg_match($this->_RexPatterns['float'], $val);
    }
    public function alpha($val){    
        return (bool) preg_match($this->_RexPatterns['alpha'], $val);
    }
    public function alphaNum($val){    
        return (bool) preg_match($this->_RexPatterns['alphaNum'], $val);
    }
    public function req($val){    
        return '' != $val || !empty($val);
    }
    public function lt($val , $val2){    
        if(is_numeric($val)){
            return $val  < $val2 ;
        } elseif (is_string($val)) {
            return mb_strlen($val) < $val2;
        }
    }
    
    public function gt($value, $matchAgainst)
    {
        if(is_string($value)) {
            return mb_strlen($value) > $matchAgainst;
        } elseif (is_numeric($value)) {
            return $value > $matchAgainst;
        }
    }

    public function min($value, $min)
        {
            if(is_string($value)) {
                return mb_strlen($value) >= $min;
            } elseif (is_numeric($value)) {
                return $value >= $min;
            }
        }

    public function max($value, $max)
    {
        if(is_string($value)) {
            return mb_strlen($value) <= $max;
        } elseif (is_numeric($value)) {
            return $value <= $max;
        }
    }

    public function between($value, $min, $max)
    {
        if(is_string($value)) {
            return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
        } elseif (is_numeric($value)) {
            return $value >= $min && $value <= $max;
        }
    }

    public function floatlike($value, $beforeDP, $afterDP)
    {
        if(!$this->float($value))
        {
            return false;
        }
        $pattern = '/^[0-9]{' . $beforeDP . '}\.[0-9]{' . $afterDP . '}$/';
        return (bool) preg_match($pattern, $value);
    }
    
    public function eq($value, $matchAgainst)
    {
        return $value == $matchAgainst;
    }

    public function eq_field($value, $otherFieldValue)
    {
        return $value == $otherFieldValue;
    }

    public function vdate($value)
    {
        return (bool) preg_match($this->_RexPatterns['vdate'], $value);
    }

    public function email($value)
    {
        return (bool) preg_match($this->_RexPatterns['email'], $value);
    }

    public function url($value)
    {
        return (bool) preg_match($this->_RexPatterns['url'], $value);
    }

    public function isValid( $roles, $inputType)
    {
        $errors = [];
//        var_dump($roles);
        if(!empty($roles)){
            foreach ($roles as $fieldName=> $validationRoles){
                $value = $inputType[$fieldName];
//                var_dump($fieldName);
                $validationRoles = explode('|', $validationRoles);
                foreach ($validationRoles as $validationRole){
                    if(preg_match_all('/(min)\((\d+)\)/', $validationRole, $m)){                        
//                        var_dump($m);
                         if( $this->min($value, $m[2][0]) === false ){  
//                             var_dump( $m[2][0]);
//                             var_dump( $m[1][0]);
//                             var_dump( $fieldName );
                             $this->messenger->add(
//                                     $this->lang->getDictionary() ['text_label_'.$fieldName] .' ' .$this->lang->getDictionary() ['text_error_'.$m[1][0]]
                                     $this->lang->feedkey('text_error_'.$m[1][0]  , [ $this->lang->get('text_label_'.$fieldName) , $m[2][0] ])  
                                     , Messenger::APP_MESSEGE_ERROR);
                             $errors[$fieldName] = true;
                         }
                        
                    }
                    elseif(preg_match_all('/(max)\((\d+)\)/', $validationRole, $m)){                        
//                        var_dump($m);
                         if( $this->max($value, $m[2][0]) === false ){  
//                             var_dump( $m[2][0]);
//                             var_dump( $m[1][0]);
//                             var_dump( $fieldName );
                             $this->messenger->add(
//                                     $this->lang->getDictionary() ['text_label_'.$fieldName] .' ' .$this->lang->getDictionary() ['text_error_'.$m[1][0]]
                                     $this->lang->feedkey('text_error_'.$m[1][0]  , [ $this->lang->get('text_label_'.$fieldName) , $m[2][0] ])  
                                     , Messenger::APP_MESSEGE_ERROR);
                             $errors[$fieldName] = true;
                         }
                        
                    }
                    elseif(preg_match_all('/(lt)\((\d+)\)/', $validationRole, $m)){                        
//                        var_dump($m);
                         if( $this->lt($value, $m[2][0]) === false ){  
//                             var_dump( $m[2][0]);
//                             var_dump( $m[1][0]);
//                             var_dump( $fieldName );
                             $this->messenger->add(
//                                     $this->lang->getDictionary() ['text_label_'.$fieldName] .' ' .$this->lang->getDictionary() ['text_error_'.$m[1][0]]
                                     $this->lang->feedkey('text_error_'.$m[1][0]  , [ $this->lang->get('text_label_'.$fieldName) , $m[2][0] ])  
                                     , Messenger::APP_MESSEGE_ERROR);
                             $errors[$fieldName] = true;
                         }
                        
                    }
                    elseif(preg_match_all('/(gt)\((\d+)\)/', $validationRole, $m)){                        
//                        var_dump($m);
                         if( $this->gt($value, $m[2][0]) === false ){  
//                             var_dump( $m[2][0]);
//                             var_dump( $m[1][0]);
//                             var_dump( $fieldName );
                             $this->messenger->add(
//                                     $this->lang->getDictionary() ['text_label_'.$fieldName] .' ' .$this->lang->getDictionary() ['text_error_'.$m[1][0]]
                                     $this->lang->feedkey('text_error_'.$m[1][0]  , [ $this->lang->get('text_label_'.$fieldName) , $m[2][0] ])  
                                     , Messenger::APP_MESSEGE_ERROR);
                             $errors[$fieldName] = true;
                         }
                    }
                    elseif(preg_match_all('/(between)\((\d+),(\d+)\)/', $validationRole, $m)) {
                        if($this->between($value, $m[2][0], $m[3][0]) === false) {
                            $this->messenger->add(
                                $this->lang->feedKey('text_error_'.$m[1][0], [$this->lang->get('text_label_'.$fieldName), $m[2][0], $m[3][0]]),
                                messenger::APP_MESSEGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    }
                    elseif(preg_match_all('/(floatlike)\((\d+),(\d+)\)/', $validationRole, $m)) {
                        if($this->floatlike($value, $m[2][0], $m[3][0]) === false) {
                            $this->messenger->add(
                                $this->lang->feedKey('text_error_'.$m[1][0], [$this->lang->get('text_label_'.$fieldName), $m[2][0], $m[3][0]]),
                                messenger::APP_MESSEGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    }
                    elseif(preg_match_all('/(eq)\((\w+)\)/', $validationRole, $m)) {
                        if($this->eq($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->lang->feedKey('text_error_'.$m[1][0], [$this->lang->get('text_label_'.$fieldName), $m[2][0]]),
                                messenger::APP_MESSEGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(eq_field)\((\w+)\)/', $validationRole, $m)) {
                        $otherFieldValue = $inputType[$m[2][0]];
                        if($this->eq_field($value, $otherFieldValue) === false) {
                            $this->messenger->add(
                                $this->lang->feedKey('text_error_'.$m[1][0], [$this->lang->get('text_label_'.$fieldName), $this->lang->get('text_label_'.$m[2][0])]),
                                messenger::APP_MESSEGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } else {
                        if($this->$validationRole($value) === false) {
                            $this->messenger->add(
                                $this->lang->feedKey('text_error_'.$validationRole, [$this->lang->get('text_label_'.$fieldName)]),
                                messenger::APP_MESSEGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    }
                }

            }
        }
//        var_dump($errors);
        return empty($errors) ? true : false;
    }

}
