<?php
require_once 'models/almuerzo.php';
require_once 'models/almuerzoHP.php';
class AlmuerzoController
{
	public function gestion()
	{
		Utils::isCocina();
		$a = new Almuerzo();
		$alm = $a->findAlmuerzo();
		require_once 'views/almuerzo/crud.php';
	}
	public function getAll()
	{
		$a = new Almuerzo();
		$alm = $a->findAlmuerzo();
		return $alm;
	}
	//Registrar
	public function registrar()
	{
		Utils::isCocina();
		if (isset($_POST) && !empty($_POST['cantidad'])) {
			$cantidadPersona = $_POST['cantidad'];
			$alv = new Almuerzo();
			$alv->setCantidadPersonas($cantidadPersona);
			$r = $alv->save();
			if ($r) {
				$_SESSION['save'] = 'Registrado';
			} else {
				echo 'Error Registro Almuerzo';
			}
		} else {
			$_SESSION['save'] = 'Vacios';
		}
		header('Location: ' . baseUrl . 'almuerzo/gestion');
	}
	//Editar
	public function ver()
	{
		Utils::isCocina();
		$idalmuerzo = $_GET['id'];
		$almHP = new AlmuerzoHP();
		$almHP->setIdAlmuerzo($idalmuerzo);
		$a = $almHP->findAlmuerzo();
		require_once 'views/almuerzo/almuerzoHP.php';
	}
}
