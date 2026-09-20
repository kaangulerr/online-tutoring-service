<?php
namespace App\Core;

class Controller {
    
    protected function view($view, $data = []) {
        
        extract($data);
        
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View does not exist: " . $view);
        }
    }
}
