<?php
require_once 'models/stock.php';
class stockController
{
  public function consultar()
  {
    Utils::isCocina();
    $stock = new Stock();
    $sto = $stock->All();
    require_once 'views/producto/stock/consultarStock.php';
  }
  // Registro
  public function registro()
  {
    Utils::isCocina();
    require_once 'views/producto/stock/registrar.php';
  }

  //PDF Todo
  public function pdf()
  {
    $st = new Stock();
    $stock = $st->All();
    require_once 'lib/pdf/stock/pdfStock.php';
  }

  public function registrar()
  {
    Utils::isCocina();
    // Verificamos si hay datos por POST
    if (isset($_POST) && (!empty($_POST['producto']) || !empty($_GET['id'])) && !empty($_POST['cantidad']) && !empty($_POST['fecha']) && !empty($_POST['lote'])) {
      // Creamos el contenedor
      $stock = new Stock();
      if (!empty($_GET['id'])) {
        $s = new Stock();
        $s->setIdProducto($_GET['id']);
        $rrr = $s->findID();
        //
        $cantActual = $rrr->cantidadProducto;
        $newCant = $cantActual + ($_POST['cantidad']);
        if ($newCant < 0) {
          $_SESSION['saveEdit'] = 'Yuca';
          header('Location: ' . baseUrl . 'stock/editar&id=' . $_GET['id']);
          die();
        }
        //
        $stock->setIdProducto($_GET['id']);
        $stock->setCantidadProducto($newCant);
      } elseif (!empty($_POST['producto'])) {
        $stock->setIdProducto($_POST['producto']);
        $stock->setCantidadProducto($_POST['cantidad']);
      }
      $stock->setFecha($_POST['fecha']);
      $stock->setLote($_POST['lote']);

      // Realizamos el Registro
      if (isset($_GET['id'])) {
        $save = $stock->update();
      } else {
        $save = $stock->save();
      }
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
        header('Location: ' . baseUrl . 'stock/consultar');
      } else {
        $_SESSION['saveEdit'] = 'Existe';
        header('Location: ' . baseUrl . 'stock/registro');
        die();
      }
    } else {
      if (isset($_GET['id'])) {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'stock/editar&id=' . $_GET['id']);
      } else {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'stock/registro');
      }
    }
  }

  // Editar
  public function editar()
  {
    Utils::isCocina();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $stock = new Stock();
      //
      $stock->setIdProducto($id);
      $stock = $stock->findID();
      require_once 'views/producto/stock/registrar.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  // Eliminar
  public function eliminar()
  {
    Utils::isCocina();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $st = new Stock();
      $st->setIdProducto($id);
      $delete = $st->delete();
      $_SESSION['delete'] = 'Eliminado';
      if (!$delete) {
        $_SESSION['delete'] = 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'stock/consultar');
  }
}
