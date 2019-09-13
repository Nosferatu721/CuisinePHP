<?php

class Restaurante
{
  private $db;
  private $id;
  private $nombre;
  private $direccion;

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

  // GET - SET Direccion
  function getDireccion()
  {
    return $this->direccion;
  }
  function setDireccion($direccion)
  {
    $this->direccion = $this->db->real_escape_string($direccion);
  }

  // Consultar Todos
  public function findRestaurant(){
    // Crear Sentencia
    $sql = "SELECT * FROM restaurante ORDER BY nombreRestaurante ASC";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  public function findRestaurantID()
  {
    $sql = "SELECT * FROM restaurante WHERE idrestaurante={$this->getId()}";
    $restaurant = $this->db->query($sql);
    return $restaurant->fetch_object();
  }

  //Registrar
  public function save(){
    $sql = "INSERT INTO restaurante VALUES (NULL, '{$this->getNombre()}', '{$this->getDireccion()}')";
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
    $sql = "UPDATE restaurante SET nombreRestaurante='{$this->getNombre()}', direccionRestaurante='{$this->getDireccion()}' WHERE idrestaurante='{$this->id}'";
    $update = $this->db->query($sql);
    $result = false;
    if ($update) {
      $result = true;
    }
    return $result;
  }
  // Eliminar
  public function delete(){
    $sql = "DELETE FROM restaurante WHERE idrestaurante = '{$this->id}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
