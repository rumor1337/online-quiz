<?php
spl_autoload_register(function ($class_name) {
    $base_path = __DIR__ . '/../';
    
    $directories = [
        'Core/',
        'controllers/',
    ];

    foreach ($directories as $dir) {
        $file = $base_path . $dir . $class_name . '.php';
        
        if (file_exists($file)) {
            require_once $file;
            return; 
        }
    }
});