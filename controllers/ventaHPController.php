<?php
require_once 'models/venta.php';
require_once 'models/ventaHP.php';

class VentaHPController
{
  public function gestion()
  {
    Utils::isCocina();
    require_once 'views/venta/ventaHP.php';
  }
  public static function getAll($id)
  {
    $vHP = new VentaHP();
    $vHP->setIdVenta($id);
    $venHP = $vHP->find();
    return $venHP;
  }

  //Funcion ver
  public function ver()
  {
    Utils::isCocina();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $id = $_GET['id'];
      $ven = new Venta();
      $ventas = $ven->find();
      ///
      $exist = false;
      foreach ($ventas as $p) {
        $idped = (int) $p['idventa'];
        if ($id == $idped) {
          $exist = true;
          break;
        }
      }
      ///
      if ($exist) {
        require_once 'views/venta/ventaHP.php';
      } else {
        header('Location: ' . baseUrl . 'error/index');
      }
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  // Registrar
  public function registrar()
  {
    Utils::isCocina();
    if (isset($_POST) && !empty($_POST['producto']) && !empty($_POST['cantidad'])) {
      //Almacenar datos en variables
      $producto = $_POST['producto'];
      $cantidad = $_POST['cantidad'];
      $idven = $_GET['id'];
      $venHP = new VentaHP();
      //apuntan los datos
      $venHP->setIdVenta($idven);
      $venHP->setIdProducto($producto);
      $venHP->setCantVend($cantidad);
      // Almacenamos los Datos
      // Realizamos el INSERT O UPDATE
      $save = $venHP->save();
      // Verificamos si fue Exitoso :v
      if ($save) {
        $_SESSION['save'] = 'Registrado';
      } else {
        echo 'ErrorRegistro';
      }
    } else {
      $_SESSION['save'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'ventaHP/ver&id=' . $_GET['id']);
  }

  public function eliminar()
  {
    Utils::isCocina();
    if (isset($_GET['id']) && $_GET['id'] != ''  && $_GET['idv'] != '') {
      $idpro = $_GET['id'];
      $idven = $_GET['idv'];
      $p = new VentaHP();
      $p->setIdproducto($idpro);
      $p->setIdVenta($idven);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
      header('Location: ' . baseUrl . 'ventaHP/ver&id=' . $_GET['idv']);
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  //TODO:Cambiar metodos a VENTA!!!

}
