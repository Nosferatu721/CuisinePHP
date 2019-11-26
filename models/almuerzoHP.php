<?php

class AlmuerzoHP
{
	private $db;
	private $idalmuerzo;
	private $idproducto;
	private $cantidadProducto;
	private $cantidadIndividual;
	private $precioTotal;

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

	function getCantidadIndividual()
	{
		return $this->cantidadIndividual;
	}

	function setCantidadIndividual($cantidadIndividual)
	{
		$this->cantidadIndividual = $cantidadIndividual;
	}

	function getPrecioT()
	{
		return $this->precioTotal;
	}

	function setPrecioT($precioTotal)
	{
		$this->precioTotal = $precioTotal;
	}

	//Crear sentencias SQL
	public function find()
	{
		$sql = "SELECT * FROM almuerzoPersonal_has_producto INNER JOIN producto ON almuerzoPersonal_has_producto.producto_idproducto = producto.idproducto  WHERE almuerzoPersonal_idalmuerzoPersonal = {$this->getIdAlmuerzo()}";
		$result = $this->db->query($sql);
		return $result;
	}

	public function findID()
	{
		$sql = "SELECT * FROM almuerzoPersonal_has_producto WHERE almuerzoPersonal_idalmuerzoPersonal = {$this->getIdAlmuerzo()}";
		$result = $this->db->query($sql);
		return $result->fetch_object();
	}

	public function save()
	{
		$sql = "INSERT INTO almuerzopersonal_has_producto VALUES ({$this->getIdAlmuerzo()}, {$this->getIdProducto()}, {$this->getCantidadProducto()}, {$this->getCantidadIndividual()}, {$this->getPrecioT()})";
		$saved = $this->db->query($sql);
		$result = false;
		if ($saved) {
			$result = true;
		}
		return $result;
	}

	public function delete()
	{
		$sql = "DELETE FROM almuerzoPersonal_has_producto WHERE almuerzoPersonal_idalmuerzoPersonal = {$this->getIdAlmuerzo()} AND producto_idproducto = {$this->getIdProducto()}";
		$delete = $this->db->query($sql);
		$result = false;
		if ($delete) {
			$result = true;
		}
		return $result;
	}
}
