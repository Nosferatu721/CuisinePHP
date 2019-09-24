<?php
require_once 'models/venta.php';
require_once 'models/ventaHP.php';

class VentaController
{
  public function gestion()
  {
    Utils::isCocina();
    $p = new Venta();
    $ped = $p->find();
    require_once 'views/venta/crud.php';
  }
  public static function getAll()
  {
    $v = new Venta();
    $ven = $v->find();
    return $ven;
  }
  // Registrar
  public function registrar()
  {
    Utils::isCocina();
    
      $ven = new Venta();
      // Almacenamos los Datos
      // Realizamos el INSERT O UPDATE
        $save = $ven->save();
    

      // Verificamos si fue Exitoso :v
      if ($save) {
          $_SESSION['saveEdit'] = 'Registrado';
      } else {
        $_SESSION['error'] = 'ErrorRegistro';
      }
    header('Location: ' . baseUrl . 'venta/gestion');
  }

  // Editar
  public function ver(){
    Utils::isCocina();
    $idVenta= $_GET['id'];
    $venHP = new VentaHP();
    $venHP-> setIdVenta($idVenta);
    $v = $venHP-> find();
    require_once 'views/venta/ventaHP.php';
  }
}
