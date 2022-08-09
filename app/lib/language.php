<?php
namespace PHPMVC\LIB;

/**
 * Description of Language
 *
 * @author emadr
 */


class Language {
    
    private  $dictionary = [];
    public function load( $path ){
        $defaultlang = APP_DEFAULT_LANG;
        if(isset($_SESSION['lang'])){
            $defaultlang = $_SESSION['lang'];
        }
        $arrPath = explode('.', $path);
        $file = LANG_PATH . $defaultlang .DS. $arrPath[0] . DS . $arrPath[1] . '.lang' . '.php';
        if(file_exists($file)){
            require $file;
            if(is_array($_lang) && !empty($_lang)){
                foreach ($_lang  as $key => $value){
                    $this->dictionary[$key] = $value;
                }
            }
        }
        else {
            trigger_error('Sorry the language file ' . $path . ' doens\'t exists', E_USER_WARNING);
        }
    }
    
    
    public function feedkey($key , $data ){
        
        if(array_key_exists($key, $this->dictionary)) {     
            array_unshift($data, $this->dictionary[$key]);            
            return  call_user_func_array('sprintf' ,$data);;
        }
        
    }
    
    public function get($key){
        if(array_key_exists($key, $this->dictionary)){
            return $this->dictionary[$key];
        }
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }
    
    
}
