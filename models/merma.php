<?php

class Merma
{
  private $db;
  private $idMerma;
  private $cantidad;
  private $motivo;
  private $idTipoMerma;
  private $idProducto;
  private $perdida;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  //
  function getIdMerma()
  {
    return $this->idMerma;
  }
  function setIdMerma($idMerma)
  {
    $this->idMerma = $idMerma;
  }
  // GET - SET Cantidad
  function getCantidad()
  {
    return $this->cantidad;
  }
  function setCantidad($cantidad)
  {
    $this->cantidad = $this->db->real_escape_string($cantidad);
  }
  
  // GET - SET Motivo
  function getMotivo()
  {
    return $this->motivo;
  }
  function setMotivo($motivo)
  {
    $this->motivo = $this->db->real_escape_string($motivo);
  }
  // GET - SET Tipo de Merma
  function getIdTipoMerma()
  {
    return $this->idTipoMerma;
  }
  function setIdTipoMerma($idTipoMerma)
  {
    $this->idTipoMerma = $this->db->real_escape_string($idTipoMerma);
  }
  // GET - SET ID Producto
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }
  
  function getPerdida()
  {
    return $this->perdida;
  }
  function setPerdida($perdida)
  {
    $this->perdida = $this->db->real_escape_string($perdida);
  }



  // Consultar Todos
  public function All()
  {
    // Crear Sentencia
    $sql = "CALL findMerma({$_SESSION['identity']->idrestaurante})";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  public function findMermaID()
  {
    $sql = "CALL findMermaID({$_SESSION['identity']->idrestaurante}, {$this->getIdMerma()})";
    $producto = $this->db->query($sql);
    return $producto->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "CALL insertUpdmerma ('{$this->getCantidad()}', '{$this->getPerdida()}','{$this->getMotivo()}', '{$this->getIdTipoMerma()}', {$_SESSION['identity']->idrestaurante}, '{$this->getIdProducto()}')";
    $saved = $this->db->query($sql);
    $result = false;
    if ($saved) {
      $result = true;
    }
    return $result;
  }
  // Editar
  public function update()
  {
    $sql = "UPDATE merma SET cantidadMerma='{$this->getCantidad()}', perdida='{$this->getPerdida()}', motivoMerma='{$this->getMotivo()}', tipoMerma_idtipoMerma='{$this->getIdTipoMerma()}' WHERE idmerma={$this->idMerma} AND restaurante_idrestaurante={$_SESSION['identity']->idrestaurante}";
    $update = $this->db->query($sql);
    $result = false;
    if ($update) {
      $result = true;
    }
    return $result;
  }
  // Eliminar
  public function delete()
  {
    $sql = "CALL deleteUpdmerma ({$this->idMerma})";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }

  // Consulta Por Fecha
  public function findForDate($fechaInicial, $fechaFinal)
  {
    $sql = "CALL findMermaDATE({$_SESSION['identity']->idrestaurante}, '$fechaInicial', '$fechaFinal')";
    $result = $this->db->query($sql);
    return $result;
  }
}
