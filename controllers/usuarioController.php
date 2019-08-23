<?php
require_once 'models/usuario.php';
class usuarioController
{
  public function index()
  {
    require_once 'views/usuario/index.php';
  }
  public function login()
  {
    require_once 'views/login.php';
  }
  public function olvidoPass()
  {
    require_once 'views/olvidePass.php';
  }
  public function d(){
    if (isset($_POST) && !empty($_POST['id'])) {
      $u = new Usuario();
      $u->setId($_POST['id']);
      $dataUser = $u->findUserID();
      if ($dataUser && is_object($dataUser)) {
        require_once 'librerias/emails/contra.php';
      } else {
        $_SESSION['recuperar'] = 'UsuarioError';
        header('Location: ' . baseUrl . 'usuario/olvidoPass');
      }
    } else {
      $_SESSION['recuperar'] = 'ErrorDatos';
      header('Location: ' . baseUrl . 'usuario/olvidoPass');
    }
  }

  public function consultarUsuarios()
  {
    Utils::isAdmin();
    $usuario = new Usuario();
    $users = $usuario->findUsers();
    $usuario2 = new Usuario();
    $porcentaje = $usuario2->countUsers();
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
      // Almacenamos cada dato en el contenedor del usuario
      $usuario->setNombre($_POST['nombres']);
      $usuario->setApellido($_POST['apellidos']);
      $usuario->setPass($_POST['pass']);
      $usuario->setCargo($_POST['rol']);
      $usuario->setRestaurante($_POST['restaurante']);
      $usuario->setEmail($_POST['email']);
      // Realizamos el Registro

      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario->setId($id);
        $save = $usuario->update();
      } else {
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
        $_SESSION['error'] = 'ErrorRegistro';
        header('Location: ' . baseUrl . 'usuario/registro');
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
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

      if ($identity && is_object($identity)) {
        $_SESSION['identity'] = $identity;
        if ($identity->cargo_idcargo == 1) {
          $_SESSION['Admin'] = true;
        }
        if ($identity->cargo_idcargo == 2) {
          $_SESSION['JefeCocina'] = true;
        }
        if ($identity->cargo_idcargo == 3) {
          $_SESSION['JefeZona'] = true;
        }
        header('Location: ' . baseUrl . 'usuario/index');
      } else {
        $_SESSION['login'] = 'UsuarioError';
        header('Location: ' . baseUrl);
      }
    } else {
      $_SESSION['login'] = 'ErrorDatos';
      header('Location: ' . baseUrl);
    }
  }
  public function logout()
  {
    if (isset($_SESSION['identity'])) {
      unset($_SESSION['identity']);
    }
    if (isset($_SESSION['Admin'])) {
      unset($_SESSION['Admin']);
    } elseif (isset($_SESSION['JefeCocina'])) {
      unset($_SESSION['JefeCocina']);
    } elseif (isset($_SESSION['JefeZona'])) {
      unset($_SESSION['JefeZona']);
    } elseif (isset($_SESSION['error_login'])) {
      $_SESSION['JefeZona'] = false;
    }
    header('Location: ' . baseUrl);
  }
  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id'])) {
      $editar = true;
      //
      $id = $_GET['id'];
      $usuario = new Usuario();
      //
      $usuario->setId($id);
      $user = $usuario->findUserID();
      require_once 'views/usuario/registrar.php';
    } else {
      header('Location: ' . baseUrl . 'usuario/consultarUsuarios');
    }
  }
  // Eliminar
  public function eliminar()
  {
    Utils::isAdmin();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $usuario = new Usuario();
      $usuario->setId($id);
      $delete = $usuario->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'Error';
      }
    } else {
      $_SESSION['delete'] = 'Error';
    }
    header('Location: ' . baseUrl . 'usuario/consultarUsuarios');
  }
}