<?php

class Stock
{
  private $db;
  private $idRestaurante;
  private $idProducto;
  private $cantidadProducto;
  private $fecha;
  private $lote;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  function getIdRestaurante()
  {
    return $this->idRestaurante;
  }
  function setIdRestaurante($idRestaurante)
  {
    $this->idRestaurante = $idRestaurante;
  }

  // GET - SET Nombre
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }
  //
  function getCantidadProducto()
  {
    return $this->cantidadProducto;
  }
  function setCantidadProducto($cantidadProducto)
  {
    $this->cantidadProducto = $this->db->real_escape_string($cantidadProducto);
  }
  //
  function getFecha()
  {
    return $this->fecha;
  }
  function setFecha($fecha)
  {
    $this->fecha = $this->db->real_escape_string($fecha);
  }
  //
  function getLote()
  {
    return $this->lote;
  }
  function setLote($lote)
  {
    $this->lote = $this->db->real_escape_string($lote);
  }

  // Consultar Todos Los Restaurantes
  public function All()
  {
    // Crear Sentencia
    $sql = "CALL findStock({$_SESSION['identity']->idrestaurante})";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Usuario Por ID
  public function findID()
  {
    $sql = "CALL findStockID({$this->getIdProducto()},{$_SESSION['identity']->idrestaurante})";
    $stock = $this->db->query($sql);
    return $stock->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO restaurante_has_producto VALUES ({$_SESSION['identity']->idrestaurante}, '{$this->getIdProducto()}', '{$this->getCantidadProducto()}', '{$this->getFecha()}', '{$this->getLote()}')";
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
    $sql = "UPDATE restaurante_has_producto SET cantidadProducto='{$this->getCantidadProducto()}', fechaVencimiento='{$this->getFecha()}', lote='{$this->getLote()}' WHERE producto_idproducto={$this->getIdProducto()} AND restaurante_idrestaurante={$_SESSION['identity']->idrestaurante}";
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
    $sql = "DELETE FROM restaurante_has_producto WHERE producto_idproducto = '{$this->getIdProducto()}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
