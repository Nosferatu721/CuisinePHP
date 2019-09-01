<?php

class Cargo
{
  private $db;
  private $id;
  private $nombre;

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

  // Consultar Todos Los Restaurantes
  public function findCargo()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM cargo";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Usuario Por ID
  public function findCargoID()
  {
    $sql = "SELECT * FROM cargo WHERE idcargo={$this->getId()}";
    $cargo = $this->db->query($sql);
    return $cargo->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO cargo VALUES (NULL, '{$this->getNombre()}')";
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
    $sql = "UPDATE cargo SET nombreCargo='{$this->getNombre()}' WHERE idcargo='{$this->id}'";
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
    $sql = "DELETE FROM cargo WHERE idcargo = '{$this->id}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
