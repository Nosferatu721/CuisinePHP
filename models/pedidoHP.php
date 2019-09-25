<?php

class PedidoHP
{
  private $db;
  private $idPedido;
  private $idProducto;
  private $cantProdPed;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  function getIdPedido()
  {
    return $this->idPedido;
  }
  function setIdPedido($idPedido)
  {
    $this->idPedido = $idPedido;
  }

  // GET - SET id producto
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }

  // GET - SET IdRestaurante
  function getCantProdPed()
  {
    return $this->cantProdPed;
  }
  function setCantProdPed($cantProdPed)
  {
    $this->cantProdPed = $this->db->real_escape_string($cantProdPed);
  }

  // Consultar Todos Los Restaurantes
  public function find()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM pedido_has_producto INNER JOIN producto ON producto_idproducto = idproducto WHERE pedido_idpedido={$this->getIdPedido()}";
    // $sql = "SELECT pedido_idpedido, producto_idproducto, cantidadProdPed, nombreProducto FROM pedido_has_producto INNER JOIN producto ON pedido_has_producto.producto_idproducto = producto.idproducto";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  public function findID()
  {
    $sql = "SELECT * FROM pedido_has_producto WHERE pedido_idpedido={$this->getIdPedido()}";
    $pedido = $this->db->query($sql);
    return $pedido->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO pedido_has_producto VALUES ({$this->getIdPedido()},{$this->getIdProducto()},{$this->getCantProdPed()})";
    $saved = $this->db->query($sql);
    $result = false;
    if ($saved) {
      $result = true;
    }
    return $result;
  }
  // Eliminar
  public function delete()
  {
    $sql = "DELETE FROM pedido_has_producto WHERE pedido_idpedido = {$this->getidPedido()} AND producto_idproducto={$this->getIdProducto()} ";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
