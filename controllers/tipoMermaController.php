<?php
require_once 'models/tipoMerma.php';

class TipoMermaController
{
  public function gestion()
  {
    Utils::isAdmin();
    $tp = new TipoMerma();
    $tipos = $tp->findTipos();
    require_once 'views/merma/tipoMerma/crud.php';
  }
  public static function getAll()
  {
    $tp = new TipoMerma();
    $tipos = $tp->findTipos();
    return $tipos;
  }
  // Registrar
  public function registrar()
  {
    Utils::isAdmin();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['nombre'])) {
      // Almacenamos los Datos en variables
      $nombre = $_POST['nombre'];
      // Creamos un Objeto Restaurante
      $tp = new TipoMerma();
      // Almacenamos los Datos
      $tp->setTipo($nombre);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $tp->setId($id);
        $save = $tp->update();
      } else {
        $save = $tp->save();
      }
      // Verificamos si fue Exitoso :v
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
      } else {
        $_SESSION['error'] = 'ErrorRegistro';
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
    }
    header('Location: ' . baseUrl . 'tipoMerma/gestion');
  }

  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $tp = new TipoMerma();
      //
      $tp->setId($id);
      $tipoEdit = $tp->findTipoMID();
      require_once 'views/merma/tipoMerma/crud.php';
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
      $tp = new TipoMerma();
      $tp->setId($id);
      $delete = $tp->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'tipoMerma/gestion');
  }
}
