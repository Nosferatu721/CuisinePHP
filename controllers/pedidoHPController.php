<?php
require_once 'models/pedidoHP.php';

class pedidoHPController
{
  public function gestion()
  {
    Utils::isCocina();
    require_once 'views/pedido/pedidoHP.php';
  }
  public static function getAll($id)
  {
    $p = new PedidoHP();
    $p->setIdPedido($id);
    $pedHP = $p->find();
    return $pedHP;
  }

  public function ver()
  {
    Utils::isCocina();
    require_once 'views/pedido/pedidoHP.php';
  }



  // Registrar
  public function registrar()
  {
    Utils::isCocina();
    if (isset($_POST) && !empty($_POST['producto']) && !empty($_POST['cantidad'])) {
      // Almacenamos los Datos en variables
      $producto = $_POST['producto'];
      $cantidad = $_POST['cantidad'];
    $idped = $_GET['id'];
    $pedHP = new PedidoHP();
    $pedHP-> setIdPedido($idped);
    $pedHP-> setIdProducto($producto);
    $pedHP-> setCantProdPed($cantidad);
    // Almacenamos los Datos
    // Realizamos el INSERT O UPDATE
    $save = $pedHP->save();
    // Verificamos si fue Exitoso :v
    if ($save) {
      $_SESSION['saveEdit'] = 'Registrado';
    } else {
      $_SESSION['error'] = 'ErrorRegistro';
    }
  }
    header('Location: ' . baseUrl . 'pedidoHP/ver&id=' . $_GET['id']);
  }

  public function eliminar(){
    Utils::isCocina();
    if (isset($_GET['id']) && $_GET['id'] != ''  && $_GET['idp'] != '') {
      $idpro = $_GET['id'];
      $idped = $_GET['idp'];
      $p = new PedidoHP();
      $p->setIdproducto($idpro);
      $p->setIdPedido($idped);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
      header('Location: ' . baseUrl . 'pedidoHP/ver&id=' . $_GET['idp']);
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
}
