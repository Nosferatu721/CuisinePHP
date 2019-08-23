<?php
session_start();
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
// Cargamos helpers :v
require_once 'helpers/utils.php';
// LLamamos el header ( head )
require_once 'views/layout/header.php';

// Mostrar Error 404
function showError()
{
  $error = new errorController();
  $error->index();
}

// Comprobamos si existe algun Controlador
if (isset($_GET['controller'])) {
  // Guardamos el Controlador en una Variable
  $nombreController = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
  // Si no existe un controlador asignamos uno por Defecto
  $nombreController = controllerDefault;
} else {
  showError();
  exit();
}

// Comprobar si existe la Clase Controladora
if (class_exists($nombreController)) {
  // Instanciamos el controlador
  $controller = new $nombreController();
  // Ahora comprobamos si existe un ( action ) y si el action existe en el controlador
  if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
    // Guardamos el action
    $action = $_GET['action'];
    // Ejecutar peticion
    $controller->$action();
  } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $actionDefault = actionDefault;
    $controller->$actionDefault();
  } else {
    showError();
  }
} else {
  showError();
}

