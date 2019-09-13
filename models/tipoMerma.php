<?php

class TipoMerma
{
  private $db;
  private $id;
  private $tipo;

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
  function getTipo()
  {
    return $this->tipo;
  }
  function setTipo($tipo)
  {
    $this->tipo = $this->db->real_escape_string($tipo);
  }

  // Consultar Todos
  public function findTipos()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM tipomerma";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  public function findTipoMID()
  {
    $sql = "SELECT * FROM tipomerma WHERE idtipoMerma={$this->getId()}";
    $tipo = $this->db->query($sql);
    return $tipo->fetch_object();
  }

  // Registrar
  public function save()
  {
    $sql = "INSERT INTO tipomerma VALUES (NULL, '{$this->getTipo()}')";
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
    $sql = "UPDATE tipomerma SET tipoMerma='{$this->getTipo()}' WHERE idtipoMerma='{$this->id}'";
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
    $sql = "DELETE FROM tipomerma WHERE idtipoMerma = '{$this->id}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
