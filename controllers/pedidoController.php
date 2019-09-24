<?php
require_once 'models/pedido.php';
require_once 'models/pedidoHP.php';

class PedidoController
{
  public function gestion()
  {
    Utils::isCocina();
    $p = new Pedido();
    $ped = $p->findPedido();
    require_once 'views/pedido/crud.php';
  }
  public static function getAll()
  {
    $p = new Pedido();
    $ped = $p->findPedido();
    return $ped;
  }
  //FIXME: revisar si es necesaria
  /* public static function getAllHP()
  {
    $p = new PedidoHP();
    $ped = $p->find();
    
    return $ped;
  } */
  // Registrar
  public function registrar()
  {
    Utils::isCocina();

    $ped = new Pedido();
    // Almacenamos los Datos
    // Realizamos el INSERT O UPDATE
    $save = $ped->save();
    // Verificamos si fue Exitoso :v
    if ($save) {
      $_SESSION['saveEdit'] = 'Registrado';
    } else {
      $_SESSION['error'] = 'ErrorRegistro';
    }
    header('Location: ' . baseUrl . 'pedido/gestion');
  }

  // Editar
  public function ver()
  {
    Utils::isCocina();
    $idPedido = $_GET['id'];
    $pedHP = new PedidoHP();
    $pedHP->setIdPedido($idPedido);
    $p = $pedHP->find();
    require_once 'views/pedido/pedidoHP.php';
  }
}
