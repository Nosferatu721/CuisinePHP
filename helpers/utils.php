<?php
class Utils
{
  public static function deleteSession($name)
  {
    if (isset($_SESSION[$name])) {
      $_SESSION[$name] = null;
      unset($_SESSION[$name]);
    }
    return $name;
  }

  public static function callLanguaje()
  {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') {
      require_once 'assets/lang/es.php';
    } elseif (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
      require_once 'assets/lang/en.php';
    } else {
      require_once 'assets/lang/es.php';
    }
  }
  
  public static function defineTheme()
  {
    if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
      define('theme', 'light');
    } elseif (isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark') {
      define('theme', 'dark');
    } else {
      define('theme', 'light');
    }
  }
  
  public static function traerHeader()
  {
    $action = isset($_GET['action']) ? $_GET['action']: '';
    if (!($action == 'pdf' || $action == 'PDFFecha')) {
      require_once 'views/layout/header.php';
    }
  }

  public static function verifySession()
  {
    if (!isset($_SESSION['identity'])) {
      $action = $_GET['action'];
      if ($action != 'olvidoPass') {
        header('Location: ' . baseUrl);
      }
    }
  }

  public static function isAdmin()
  {
    if ($_SESSION['identity']->idcargo == '1') {
      return true;
    } else {
      header('Location: ' . baseUrl . 'usuario/index');
    }
  }

  public static function isCocina()
  {
    if ($_SESSION['identity']->idcargo == '2') {
      return true;
    } else {
      header('Location: ' . baseUrl . 'usuario/index');
    }
  }

  // Alerts
  public static function alerta($color, $texto, $icon = '')
  {
    echo '<div class="alert alert-secondary  text-' . $color . ' p-1 text-center animated zoomIn faster" role="alert">'
      . $texto . ' <i class="' . $icon . '"></i></div>';
  }
}
