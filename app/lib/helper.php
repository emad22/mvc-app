<?php
namespace PHPMVC\LIB;
trait helper {
    public function redirect($path) {
        header('Location:'. $path);
    }
}
