<?php

class PedidoHP
{
  private $db;
  private $id;
  private $idProducto;
  private $cantidad;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  function getId()
  {
    return $this->id;
  }
  function setId($id)
  {
    $this->id = $id;
  }

  // GET - SET
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }

  // GET - SET
  function getCantidad()
  {
    return $this->cantidad;
  }
  function setCantidad($cantidad)
  {
    $this->cantidad = $this->db->real_escape_string($cantidad);
  }

  // Consultar Todos
  public function findPtosHP()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM pedido_has_producto";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  // public function findProductoID()
  // {
  //   $sql = "SELECT * FROM producto WHERE idproducto={$this->getId()}";
  //   $producto = $this->db->query($sql);
  //   return $producto->fetch_object();
  // }

  //Registrar
  // public function save()
  // {
  //   $sql = "INSERT INTO producto VALUES (NULL, '{$this->getNombre()}', '{$this->getPrecio()}')";
  //   $saved = $this->db->query($sql);
  //   $result = false;
  //   if ($saved) {
  //     $result = true;
  //   }
  //   return $result;
  // }
  // // Editar
  // public function update()
  // {
  //   $sql = "UPDATE producto SET nombreProducto='{$this->getNombre()}', precioProducto='{$this->getPrecio()}' WHERE idproducto='{$this->id}'";
  //   $update = $this->db->query($sql);
  //   $result = false;
  //   if ($update) {
  //     $result = true;
  //   }
  //   return $result;
  // }
  // // Eliminar
  // public function delete()
  // {
  //   $sql = "DELETE FROM producto WHERE idproducto = '{$this->id}'";
  //   $delete = $this->db->query($sql);
  //   $result = false;
  //   if ($delete) {
  //     $result = true;
  //   }
  //   return $result;
  // }
}
