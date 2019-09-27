<?php
require_once 'models/merma.php';
require_once 'models/producto.php';

class MermaController
{
  public function consultarMerma()
  {
    Utils::isCocina();
    $m = new Merma();
    $merma = $m->All();
    require_once 'views/merma/consultarMerma.php';
  }
  // Registro
  public function registro()
  {
    Utils::isCocina();
    require_once 'views/merma/registrar.php';
  }

  //PDF For Date
  public function PDFFecha()
  {
    Utils::isCocina();
    if (isset($_POST) && !empty($_POST['fechaInicial']) && !empty($_POST['fechaFinal'])) {
      $fechaIni = $_POST['fechaInicial'];
      $fechaFin = $_POST['fechaFinal'];
      $merma = new Merma();
      $merma = $merma->findForDate($fechaIni, $fechaFin);
      require_once 'lib/pdf/merma/pdfMerma.php';
    } else {
      $_SESSION['pdfFechas'] = 'FechasVacias';
      header('Location: ' . baseUrl . 'merma/consultarMerma');
    }
  }

  //PDF
  public function pdf()
  {
    Utils::isCocina();
    $mr = new Merma();
    $merma = $mr->All();
    require_once 'lib/pdf/merma/pdfMerma.php';
  }

  public function registrar()
  {
    Utils::isCocina();
    // Verificamos si hay datos por POST
    if (isset($_POST) && (!empty($_POST['producto']) || !empty($_GET['id'])) && !empty($_POST['cantidad']) && !empty($_POST['motivo']) && !empty($_POST['tipoMerma'])) {
      // Creamos el contenedor
      $merma = new Merma();
      // Si esta editando
      if (!empty($_GET['id'])) {
        $m = new Merma();
        $m->setIdMerma($_GET['id']);
        $rrr = $m->findMermaID();
        //
        $cantActual = $rrr->cantidadMerma;
        $newCant = $cantActual + ($_POST['cantidad']);
        //
        $merma->setIdMerma($_GET['id']);
        $merma->setIdProducto($rrr->producto_idproducto);
      } elseif (!empty($_POST['producto'])) {
        $merma->setIdProducto($_POST['producto']);
      }
      $cantidad = isset($_GET['id']) ? $newCant : (int) $_POST['cantidad'];
      if ($cantidad < 0) {
        $_SESSION['saveEdit'] = 'Yuca';
        if (!empty($_GET['id'])) {
          header('Location: ' . baseUrl . 'merma/editar&id=' . $_GET['id']);
        } else {
          header('Location: ' . baseUrl . 'merma/registro');
        }
        exit();
      }
      $merma->setCantidad($cantidad);
      $merma->setIdTipoMerma($_POST['tipoMerma']);
      $merma->setMotivo($_POST['motivo']);
      //
      if ($merma->getIdTipoMerma() == 1) {
        // Calcular Perdida
        $p = new Producto();
        $p->setId(isset($_GET['id']) ? $rrr->producto_idproducto : $_POST['producto']);
        $result = $p->findProductoID();
        $precio = $result->precioProducto;
        $perdida = $cantidad * $precio;
        $merma->setPerdida($perdida);
      } else {
        $merma->setPerdida(0);
      }
      // Realizamos el Registro
      if (isset($_GET['id'])) {
        $save = $merma->update();
      } else {
        $save = $merma->save();
      }
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
      }
      header('Location: ' . baseUrl . 'merma/consultarMerma');
    } else {
      if (isset($_GET['id'])) {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'merma/editar&id=' . $_GET['id']);
      } else {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'merma/registro');
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
      $mr = new Merma();
      //
      $mr->setIdMerma($id);
      $mr = $mr->findMermaID();
      require_once 'views/merma/registrar.php';
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
      $mr = new Merma();
      $mr->setIdMerma($id);
      $delete = $mr->delete();
      $_SESSION['delete'] = 'Eliminado';
      if (!$delete) {
        $_SESSION['delete'] = 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'merma/consultarMerma');
  }
}
