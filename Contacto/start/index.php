<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require_once '../model/database.php';
 
  $controller = 'pqrs';
// Todo esta l贸gica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "../control/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;    
    $controller->Index();    
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "../control/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}