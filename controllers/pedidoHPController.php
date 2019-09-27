<?php
require_once 'models/pedido.php';
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
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $id = $_GET['id'];
      $ped = new Pedido();
      $pedidos = $ped->findPedido();
      ///
      $exist = false;
      foreach ($pedidos as $p) {
        $idped = (int) $p['idpedido'];
        if ($id == $idped) {
          $exist = true;
          break;
        }
      }
      ///
      if ($exist) {
        require_once 'views/pedido/pedidoHP.php';
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
      // Almacenamos los Datos en variables
      $producto = $_POST['producto'];
      $cantidad = $_POST['cantidad'];
      $idped = $_GET['id'];
      $pedHP = new PedidoHP();
      // Almacenamos los Datos
      $pedHP->setIdPedido($idped);
      $pedHP->setIdProducto($producto);
      $pedHP->setCantProdPed($cantidad);
      // Realizamos el INSERT
      $save = $pedHP->save();
      // Verificamos si fue Exitoso :v
      if ($save) {
        $_SESSION['save'] = 'Registrado';
      } else {
        echo 'ErrorRegistro';
      }
    } else {
      $_SESSION['save'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'pedidoHP/ver&id=' . $_GET['id']);
  }

  public function eliminar()
  {
    Utils::isCocina();
    if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['id']) && $_GET['idp'] != '') {
      $idpro = $_GET['id'];
      $idped = $_GET['idp'];
      $p = new PedidoHP();
      $p->setIdproducto($idpro);
      $p->setIdPedido($idped);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        echo 'ErrorDelete';
      }
      header('Location: ' . baseUrl . 'pedidoHP/ver&id=' . $_GET['idp']);
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
}
