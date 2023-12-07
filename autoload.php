<?php

spl_autoload_register(function ($className) {
    // Convierte el nombre de la clase en una ruta de archivo
    $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    
    // Verifica si el archivo existe y lo incluye
    if (file_exists($classFile)) {
        include_once $classFile;
    }
});
