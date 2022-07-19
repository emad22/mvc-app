<?php
namespace PHPMVC\LIB;
trait helper {
    public function redirect($path) {
//        session_write_close();
        header('Location: ' . $path);
        exit;
    }
}
