<?php
namespace PHPMVC\LIB;
class Fileupload {
    private $name;
    private $type;
    private $size;
    private $error;
    private $tmpPath;
    
   private $fileExtension;
   private $allowedExtensions = [
        'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls'
    ];



//    { ["name"]=> string(5) "1.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(45) "C:\Users\emadr\AppData\Local\Temp\php3022.tmp" ["error"]=> int(0) ["size"]=> int(306749) }
    public function __construct(array $file) {
        $this->name  = $file['name'];
        $this->tmpPath  = $file['tmp_name'];
        $this->type  = $file['type'];
        $this->error  = $file['error'];
        $this->size  = $file['size'];
        $this->name();
    }
    
    public function name(){
//        var_dump($this->name);
        preg_match_all('/([a-z]{1,4})$/i' , $this->name , $m);
//        var_dump($m);
        $this->fileExtension = $m[0][0];        
        $name = substr(strtolower(base64_encode($this->name . APP_SALT)), 0, 26);
        $name = preg_replace('/(\w{6})/i', '$1_', $name);
        $name = rtrim($name, '_');
        $this->name = $name;
        return $name;
//        var_dump($name);exit;
    }
    private function isAllowedType()
    {
//        var_dump($this->fileExtension);
        return in_array($this->fileExtension, $this->allowedExtensions);
    }
    
    
    private function isImage()
    {
//        var_dump($this->type);
        return preg_match('/image/i', $this->type);
    }
    
    private function isSizeNotAcceptable()
    {
        preg_match_all('/(\d+)([MG])$/i', MAX_FILE_SIZE_ALLOWED, $matches);
//        var_dump($matches[1][0]);  // 500
        $maxFileSizeToUpload = $matches[1][0];
        $sizeUnit = $matches[2][0];
        $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $currentFileSize = ceil($currentFileSize);
//        var_dump(  (int) $currentFileSize > (int) $maxFileSizeToUpload ); // false
        return (int) $currentFileSize > (int) $maxFileSizeToUpload;
    }
    
    
    public function getFileName(){
        return $this->name . '.' . $this->fileExtension;
    }
    public function upload()
    {
//        var_dump($this->fileExtension);
        if($this->error != 0) {
            throw new \Exception('Sorry file didn\'t upload successfully');
        }elseif(!$this->isAllowedType()){
            throw new \Exception('Sorry files of type ' . $this->fileExtension .  ' are not allowed');
        }elseif($this->isSizeNotAcceptable()) { 
            throw new \Exception('Sorry the file size exceeds the maximum allowed size');
        }else{
            $storageFolder = $this->isImage() ? IMAGES_UPLOAD_STORAGE : DOCUMENTS_UPLOAD_STORAGE;
            if(is_writable($storageFolder)) {
                move_uploaded_file($this->tmpPath, $storageFolder . DS . $this->getFileName());
            } else {
                throw new \Exception('Sorry the destination folder is not writable');
            }
            
        }
        return $this;
    }
}
