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

  //PDF For Date
  public function PDFFecha()
  {
    Utils::isCocina();
    if (isset($_POST) && !empty($_POST['fechaInicial']) && !empty($_POST['fechaFinal'])) {
      $fechaIni = $_POST['fechaInicial'];
      $fechaFin = $_POST['fechaFinal'];
      $ven = new Venta();
      $ven = $ven -> findForDate($fechaIni, $fechaFin);
      require_once 'lib/pdf/venta/pdfVenta.php';
    } else {
      $_SESSION['pdfFechas'] = 'FechasVacias';
      header('Location: ' . baseUrl . 'venta/gestion');
    }
  }

  //PDF
  public function pdf()
  {
    $vHP = new VentaHP();
    $venHp = $vHP->All();
    require_once 'lib/pdf/venta/pdfVenta.php';
  }
}
