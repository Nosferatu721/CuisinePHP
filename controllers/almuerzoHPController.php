<?php

require_once 'models/almuerzo.php';
require_once 'models/producto.php';
require_once 'models/almuerzoHP.php';

class AlmuerzoHPController
{
	public function gestion()
	{
		Utils::isCocina();
		require_once 'views/almuerzo/almuerzoHP.php';
	}

	public static function getAll($id)
	{
		$a = new AlmuerzoHP();
		$a->setIdAlmuerzo($id);
		$alHP = $a->find();
		return $alHP;
	}

	//PDF
	public function pdf()
	{
		Utils::isCocina();
		if (!empty($_GET['id'])) {
			$almuerzo = $_GET['id'];
			$a = new Almuerzo();
			$a->setIdAlmuerzo($almuerzo);
			$r = $a->findId();
			if ($r->restaurante_idrestaurante == $_SESSION['identity']->idrestaurante) {
				$alvHP = new AlmuerzoHP();
				$alvHP->setIdAlmuerzo($almuerzo);
				$ptAl = $alvHP->find();
				require_once 'lib/pdf/almuerzo/pdfAlmuerzo.php';
			} else {
				header('Location: ' . baseUrl . 'error/index');
			}
		} else {
			header('Location: ' . baseUrl . 'error/index');
		}
	}

	public function ver()
	{
		Utils::isCocina();
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$id = $_GET['id'];
			$a = new Almuerzo();
			$alm = $a->findAlmuerzo();
			$exist = false;
			foreach ($alm as $a) {
				$idalm = (int) $a['idalmuerzoPersonal'];
				if ($id == $idalm) {
					$exist = true;
					break;
				}
			}
			if ($exist) {
				require_once 'views/almuerzo/almuerzoHP.php';
			} else {
				header('Location: ' . baseUrl . 'error/index');
			}
		} else {
			header('Location: ' . baseUrl . 'error/index');
		}
	}
	public function registrar()
	{
		Utils::isCocina();
		if (isset($_POST) && !empty($_POST['producto']) && !empty($_POST['cantidad'])) {
			$alvHP = new AlmuerzoHP();
			$alvHP->setIdAlmuerzo($_GET['id']);
			$alvHP->setIdProducto($_POST['producto']);
			$alvHP->setCantidadProducto($_POST['cantidad']);
			$r = $alvHP->save();
			if ($r) {
				$_SESSION['save'] = 'Registrado';
			} else {
				echo 'Error No registro';
			}
			header('Location: ' . baseUrl . 'almuerzoHP/ver&id=' . $_GET['id']);
		} else {
			header('Location: ' . baseUrl . 'almuerzoHP/ver&id=' . $_GET['id']);
		}
	}
	public function eliminar()
	{
		Utils::isCocina();
		if (isset($_GET['id']) && $_GET['id'] != ''  && $_GET['ida'] != '') {
			$id = $_GET['id'];
			$idA = $_GET['ida'];
			$al = new AlmuerzoHP();
			$al->setIdAlmuerzo($idA);
			$al->setIdProducto($id);
			$delete = $al->delete();
			if ($delete) {
				$_SESSION['delete'] = 'Eliminado';
			} else {
				echo 'Error Delete';
			}
		} else {
			$_SESSION['estado'] = 'Vacios';
		}
		$link = baseUrl . 'almuerzoHP/ver&id=' . $idA;
		header('Location: ' . $link);
	}
}

