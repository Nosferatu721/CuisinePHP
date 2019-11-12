<?php
require_once 'models/usuario.php';
class UsuarioController
{
  public function index()
  {
    require_once 'views/usuario/index.php';
  }

  public function login()
  {
    if (!isset($_SESSION['identity'])) {
      require_once 'views/login.php';
    } else {
      $this->index();
    }
  }

  public function olvidoPass()
  {
    require_once 'views/olvidePass.php';
  }

  public function d()
  {
    if (isset($_POST) && !empty($_POST['id'])) {
      $u = new Usuario();
      $u->setId($_POST['id']);
      $dataUser = $u->findUserID();
      if ($dataUser && is_object($dataUser)) {
        require_once 'lib/emails/contra.php';
      } else {
        $_SESSION['recuperar'] = 'ErrorDatos';
        header('Location: ' . baseUrl . 'usuario/olvidoPass');
      }
    } else {
      $_SESSION['recuperar'] = 'Vacios';
      header('Location: ' . baseUrl . 'usuario/olvidoPass');
    }
  }

  public function pdf()
  {
    $u = new Usuario();
    $dataUsers = $u->findUsers();
    $u2 = new Usuario();
    $porcent = $u2->countUsers();
    require_once 'lib/pdf/usuarios/pdfUsuarios.php';
  }

  public function consultarUsuarios()
  {
    Utils::isAdmin();
    $usuario = new Usuario();
    $users = $usuario->findUsers();
    $usuario2 = new Usuario();
    $porcentaje = $usuario2->countUsers();
    $usuario3 = new Usuario();
    $userActivos = $usuario3->activos();
    require_once 'views/usuario/consultarUsuarios.php';
  }

  // Registro
  public function registro()
  {
    Utils::isAdmin();
    require_once 'views/usuario/registrar.php';
  }

  public function registrar()
  {
    Utils::isAdmin();
    // Verificamos si hay datos por POST
    if (isset($_POST) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['pass']) && !empty($_POST['rol']) && !empty($_POST['restaurante']) && !empty($_POST['email'])) {
      // Creamos el contenedor del nuevo usuario
      $usuario = new Usuario();
      $usuario->setNombre($_POST['nombres']);
      $usuario->setEmail($_POST['email']);
      $usuario->setApellido($_POST['apellidos']);
      $usuario->setPass($_POST['pass']);
      $usuario->setCargo($_POST['rol']);
      $usuario->setRestaurante($_POST['restaurante']);
      // Realizamos el Registro
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario->setId($id);
        $save = $usuario->update();
      } else {
        $result = $usuario->exist();
        if (!$result->num_rows == 0) {
          $_SESSION['saveEdit'] = 'Existe';
          header('Location: ' . baseUrl . 'usuario/registro');
          die();
        }
        $save = $usuario->save();
      }

      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
        header('Location: ' . baseUrl . 'usuario/consultarUsuarios');
      } else {
        echo 'Algun Error Pendejo';
        die();
      }
    } else {
      $_SESSION['saveEdit'] = 'Vacios';
      header('Location: ' . baseUrl . 'usuario/registro');
    }
  }

  // Login
  public function logear()
  {
    if (isset($_POST) && !empty($_POST['id']) && !empty($_POST['pass'])) {
      $id = $_POST['id'];
      $pass = $_POST['pass'];

      $usuario = new Usuario();
      $usuario->setId($id);
      $usuario->setPass($pass);
      //
      $identity = $usuario->login();

      if ($identity == 'ErrorDatos') {
        $_SESSION['login'] = 'ErrorDatos';
        header('Location: ' . baseUrl);
      } elseif ($identity == 'Inactivo') {
        $_SESSION['login'] = 'Inactivo';
        header('Location: ' . baseUrl);
      } elseif ($identity && is_object($identity)) {
        $_SESSION['identity'] = $identity;
        header('Location: ' . baseUrl . 'usuario/index');
      } else {
        $_SESSION['login'] = 'ErrorPass';
        header('Location: ' . baseUrl);
      }
    } else {
      $_SESSION['login'] = 'Vacios';
      header('Location: ' . baseUrl);
    }
  }

  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $usuario = new Usuario();
      //
      $usuario->setId($id);
      $user = $usuario->findUserID();
      require_once 'views/usuario/registrar.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  // Eliminar
  public function eliminar()
  {
    Utils::isAdmin();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $usuario1 = new Usuario();
      $usuario1->setId($id);
      $un = $usuario1->findUserID();
      if ($un->estado == 'Activo') {
        $e = 'Inactivo';
      } else {
        $e = 'Activo';
      }
      $usuario2 = new Usuario();
      $usuario2->setId($id);
      $usuario2->setEstado($e);
      // var_dump($usuario2);
      // die();
      $delete = $usuario2->delete();
      $_SESSION['estado'] = 'Cambiado';
      if (!$delete) {
        echo 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'usuario/consultarUsuarios');
  }

  // Idioma
  public function lang()
  {
    if (isset($_GET['lang']) && $_GET['lang'] != '') {
      $lang = $_GET['lang'];
      if ($lang == 'en') {
        $_SESSION['lang'] = $lang;
      } elseif ($lang == 'es') {
        $_SESSION['lang'] = langDefault;
      }
      header('Location: ' . baseUrl . 'usuario/index');
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  // Tema
  public static function theme()
  {
    if (isset($_GET['t']) && $_GET['t'] != '') {
      $tema = $_GET['t'];
      if ($tema == 'light') {
        $_SESSION['theme'] = $tema;
      } elseif ($tema == 'dark') {
        $_SESSION['theme'] = $tema;
      } else {
        $_SESSION['theme'] = themeDefault;
      }
      header('Location: ' . baseUrl . 'usuario/index');
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  public function logout()
  {
    if (isset($_SESSION['identity'])) {
      $_SESSION['identity'] = null;
      unset($_SESSION['identity']);
    }
    header('Location: ' . baseUrl);
  }

  public function updatePass()
  {
    if (isset($_POST) && !empty($_POST['passOld']) && !empty($_POST['newPass']) && !empty($_POST['newPassC'])) {
      $passOld = $_POST['passOld'];
      $newPass = $_POST['newPass'];
      $newPassC = $_POST['newPassC'];
      if ($passOld == $_SESSION['identity']->contrasena) {
        if ($newPass == $newPassC) {
          $u = new Usuario();
          $u->setId($_SESSION['identity']->idusuarios);
          $u->setPass($newPass);
          $r = $u->updatePass();
          if ($r) {
            $_SESSION['passUpdated'] = true;
            $this->logout();
          } else {
            echo 'Algun Error Pendejo';
          }
        } else {
          header('Location: ' . baseUrl . 'usuario/index');
        }
      } else {
        header('Location: ' . baseUrl . 'usuario/index');
      }
    } else {
      header('Location: ' . baseUrl . 'usuario/index');
    }
  }
}
