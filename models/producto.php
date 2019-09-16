<?php

class Producto
{
  private $db;
  private $id;
  private $nombre;
  private $precio;

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

  // GET - SET Nombre
  function getNombre()
  {
    return $this->nombre;
  }
  function setNombre($nombre)
  {
    $this->nombre = $this->db->real_escape_string($nombre);
  }
  
  // GET - SET Precio
  function getPrecio()
  {
    return $this->precio;
  }
  function setPrecio($precio)
  {
    $this->precio = $this->db->real_escape_string($precio);
  }

  // Consultar Todos
  public function findPtos()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM producto";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  public function findProductoID()
  {
    $sql = "SELECT * FROM producto WHERE idproducto={$this->getId()}";
    $producto = $this->db->query($sql);
    return $producto->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO producto VALUES (NULL, '{$this->getNombre()}', '{$this->getPrecio()}')";
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
    $sql = "UPDATE producto SET nombreProducto='{$this->getNombre()}', precioProducto='{$this->getPrecio()}' WHERE idproducto='{$this->id}'";
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
    $sql = "DELETE FROM producto WHERE idproducto = '{$this->id}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
