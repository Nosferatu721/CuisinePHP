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

  public static function verifySession(){
    if (!isset($_SESSION['identity'])) {
      header('Location: ' . baseUrl);
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
}
