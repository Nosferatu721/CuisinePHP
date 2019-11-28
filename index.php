<?php
session_start();
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
// Cargamos helpers :v
require_once 'helpers/utils.php';

// Definir tema del SI
Utils::defineTheme();
// Cargamos las variables dependiendo del Idioma
Utils::callLanguaje();
// Cargamos el Header.php
Utils::traerHeader();

// Mostrar Error 404
function showError()
{
  $error = new errorController();
  require_once 'views/layout/header.php';
  $error->index();
}

if (isset($_GET['id'])) {
  if (!is_numeric($_GET['id'])) {
    showError();
    exit();
  }
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
    // Verificar si esta logeado antes de ejecutar cualquier peticion
    Utils::verifySession();
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
