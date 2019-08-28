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

  public static function isAdmin()
  {
    if (!$_SESSION['identity']->nombreCargo == 'Administrador') {
      header('Location: ' . baseUrl . 'usuario/index');
    } else {
      return true;
    }
  }
}
