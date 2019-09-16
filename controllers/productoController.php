<?php
require_once 'models/producto.php';

class ProductoController
{
  public function gestion()
  {
    Utils::isAdmin();
    $p = new Producto();
    $ptos = $p->findPtos();
    require_once 'views/producto/crud.php';
  }
  public static function getAll()
  {
    $p = new Producto();
    $ptos = $p->findPtos();
    return $ptos;
  }
  // Registrar Y Editar
  public function registrar()
  {
    Utils::isAdmin();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['nombre']) && !empty($_POST['precio'])) {
      // Almacenamos los Datos en variables
      $nombre = $_POST['nombre'];
      $precio = $_POST['precio'];
      // Creamos un Objeto Restaurante
      $pro = new Producto();
      // Almacenamos los Datos
      $pro->setNombre($nombre);
      $pro->setPrecio($precio);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro->setId($id);
        $save = $pro->update();
      } else {
        $save = $pro->save();
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
    header('Location: ' . baseUrl . 'producto/gestion');
  }

  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $pro = new Producto();
      //
      $pro->setId($id);
      $proEdit = $pro->findProductoID();
      require_once 'views/producto/crud.php';
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
      $p = new Producto();
      $p->setId($id);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'producto/gestion');
  }
}
