<?php
class Almuerzo
{
	private $db;
	private $idalmuerzo;
	private $fechaAlmuerzo;
	private $cantidadPersonas;
	private $idrestaurante;
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
	function getFechaAlmuerzo()
	{
		return $this->fechaAlmuerzo;
	}
	function setFechaAlmuerzo($fechaAlmuerzo)
	{
		$this->fechaAlmuerzo = $this->db->real_escape_string($fechaAlmuerzo);
	}
	function getCantidadPersonas()
	{
		return $this->cantidadPersonas;
	}
	function setCantidadPersonas($cantidadPersonas)
	{
		$this->cantidadPersonas = $cantidadPersonas;
	}
	function getIdRestaurante()
	{
		return $this->idalmuerzo;
	}
	function setIdRestaurante($idrestaurante)
	{
		$this->idrestaurante = $this->db->real_escape_string($idrestaurante);
	}
	//Crear consultas SQL
	public function findAlmuerzo()
	{
		$sql = "SELECT * FROM almuerzopersonal WHERE restaurante_idrestaurante = {$_SESSION['identity']->idrestaurante}";
		//envio de sentencia
		$result = $this->db->query($sql);
		return $result;
	}
	public function findId()
	{
		$sql = "SELECT * FROM almuerzopersonal WHERE idalmuerzopersonal = {$this->getIdAlmuerzo()}";
		$result = $this->db->query($sql);
		return $result->fetch_object();
	}
	public function save()
	{
		$sql = "INSERT INTO almuerzopersonal VALUES (NULL,CURDATE(),{$this->getCantidadPersonas()}, {$_SESSION['identity']->idrestaurante})";
		$saved = $this->db->query($sql);
		$result = false;
		if ($saved) {
			$result = true;
		}
		return $result;
	}
}
