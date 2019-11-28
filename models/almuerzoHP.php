<?php

class AlmuerzoHP
{
	private $db;
	private $idalmuerzo;
	private $idproducto;
	private $cantidadProducto;

	public function __construct()
	{
		$this->db = DataBase::conectar();
	}

	//Getters y Setters
	function getIdAlmuerzo()
	{
		return $this->idalmuerzo;
	}

	function setIdAlmuerzo($idalmuerzo)
	{
		$this->idalmuerzo = $idalmuerzo;
	}

	function getIdProducto()
	{
		return $this->idproducto;
	}

	function setIdProducto($idproducto)
	{
		$this->idproducto = $this->db->real_escape_string($idproducto);
	}

	function getCantidadProducto()
	{
		return $this->cantidadProducto;
	}

	function setCantidadProducto($cantidadProducto)
	{
		$this->cantidadProducto = $cantidadProducto;
	}

	//Crear sentencias SQL
	public function find()
	{
		$sql = "SELECT * FROM almuerzopersonal_has_producto INNER JOIN producto on idproducto=producto_idproducto WHERE almuerzoPersonal_idalmuerzoPersonal = {$this->getIdAlmuerzo()}";
		$result = $this->db->query($sql);
		return $result;
	}

	public function findId()
	{
		$sql = "SELECT * FROM almuerzopersonal_has_producto WHERE almuerzoPersonal_idalmuerzoPersonal = {$this->getIdAlmuerzo()}";
		$result = $this->db->query($sql);
		return $result->fetch_object();
	}

	public function save()
	{
		$sql = "INSERT INTO almuerzopersonal_has_producto VALUES ({$this->getIdAlmuerzo()}, {$this->getIdProducto()}, {$this->getCantidadProducto()},((SELECT {$this->getCantidadProducto()}/cantidadPersonas FROM almuerzopersonal WHERE idalmuerzoPersonal = {$this->getIdAlmuerzo()})),((SELECT precioProducto*{$this->getCantidadProducto()} FROM producto WHERE idproducto = {$this->getIdProducto()})))";
		$saved = $this->db->query($sql);
		$result = false;
		if ($saved) {
			$result = true;
		}
		return $result;
	}

	public function delete()
	{
		$sql = "DELETE FROM almuerzopersonal_has_producto WHERE almuerzoPersonal_idalmuerzoPersonal= {$this->getIdAlmuerzo()}";
		$delete = $this->db->query($sql);
		$result = false;
		if ($delete) {
			$result = true;
		}
		return $result;
	}
}
