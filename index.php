<?php
session_start();
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
// Cargamos helpers :v
require_once 'helpers/utils.php';

if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') {
  require_once 'assets/lang/es.php';
} elseif (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
  require_once 'assets/lang/en.php';
} else {
  require_once 'assets/lang/es.php';
}

// Mostrar Error 404
function showError()
{
  $error = new errorController();
  require_once 'views/layout/header.php';
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
    if ($action != 'olvidoPass') {
      Utils::verifySession();
    }
    if (!($action == 'pdf')) {
      require_once 'views/layout/header.php';
    }
    $controller->$action();
  } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    require_once 'views/layout/header.php';
    $actionDefault = actionDefault;
    $controller->$actionDefault();
  } else {
    showError();
  }
} else {
  showError();
}
