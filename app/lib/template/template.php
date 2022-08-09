<?php
namespace PHPMVC\LIB\Template;

class Template {
    
    use templatehelper;
    private  $_templateparts;
    private  $_actionView;
    private  $_data;
    private  $_registry;
    
    


    public function __construct(array $parts) {
        $this->_templateparts = $parts;
    }
    public function setActionViewFile($actionFile){
        $this->_actionView  = $actionFile;
    } 
    public function setAppData($data){
        $this->_data = $data;
//        var_dump($this->_data);
    }
    public function setRegistry($registry){
        $this->_registry = $registry;
    }
    public function __get($name) {
        return $this->_registry->$name;
    }

    //to do
    public function swapTemp($temp){
        $this->_templateparts['template'] = $temp;
    }

        private function renderTemplateStart(){
        extract($this->_data);  // data for views
        require_once TEMPLATE_PATH . 'templateStart.php';
    }
    private function renderTemplateEnd(){
        extract($this->_data);  // data for views
        require_once TEMPLATE_PATH .  'templateEnd.php';
    }
    
    private function renderTemplateBlock(){
        extract($this->_data);  // data for views
        if(!array_key_exists('template', $this->_templateparts)){
            trigger_error('Sorry KeyWord Not Exist',E_USER_WARNING);
        }else {
            $parts = $this->_templateparts['template'];
//            var_dump($parts);
            if(!empty($parts)){
                
                foreach ($parts as $Keypart => $file){
                    if($Keypart === ':view'){
                        require_once  $this->_actionView;
                    } else {
                        require_once $file;
                    }
                }   
            }
        }
    }
    
    private function renderHeaderResources(){
        $output = '';
        if(!array_key_exists('header_resources', $this->_templateparts)){
            trigger_error('Sorry Header resources Not Exist',E_USER_WARNING);
        }
        else {            
            $resources = $this->_templateparts['header_resources'];
            $css = $resources['css'];
            $js = $resources['js'];
//            var_dump($css);
            if(!empty($css)){
                foreach ($css as $csspart =>$file){
                    $output .='<link rel="stylesheet"  href="' .$file. '"  type="text/css" />';
                }   
            }
            if(!empty($js)){
                foreach ($css as $jspart =>$file){
                    $output .='<script src="'.$file.'"></script>';
                }   
            }
        }
//        var_dump($output);
        return  $output;
    }
    private function renderFooterResources(){
        $output = '';
        if(!array_key_exists('footer_resources', $this->_templateparts)){
            trigger_error('Sorry Header resources Not Exist',E_USER_WARNING);
        }
        else {            
            $resources = $this->_templateparts['footer_resources'];
            
//            var_dump($css);
            if(!empty($resources)){
                foreach ($resources as $csspart =>$file){
                    $output .='<script src="'.$file.'"></script>';
                }   
            }
        }
//        var_dump($output);
        echo  $output;
    }
    
    public function RenderApp(){  
        $this->renderTemplateStart();
        echo $this->renderHeaderResources();        
        $this->renderTemplateBlock();        
        $this->renderFooterResources();
        $this->renderTemplateEnd();
    }   
}
