<?php

class Pedido
{
  private $db;
  private $idPedido;
  private $fechaPedido;
  private $idRestaurante;

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

  // GET - SET Nombre
  function getFechaPedido()
  {
    return $this->fechaPedido;
  }
  function setFechaPedido($fechaPedido)
  {
    $this->fechaPedido = $this->db->real_escape_string($fechaPedido);
  }

   // GET - SET IdRestaurante
  function getIdRestaurante()
  {
    return $this->idRestaurante;
  }
  function setIdRestaurante($idRestaurante)
  {
    $this->idRestaurante = $this->db->real_escape_string($idRestaurante);
  }

  // Consultar Todos Los Restaurantes
  public function findPedido()
  {
    // Crear Sentencia
  $sql = "SELECT * FROM pedido WHERE restaurante_idrestaurante={$_SESSION['identity']->idrestaurante}";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Pedido por ID
  public function findPedidoID()
  {
    $sql = "SELECT * FROM pedido WHERE idpedido={$this->getIdPedido()}";
    $pedido = $this->db->query($sql);
    return $pedido->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO pedido VALUES (NULL, CURDATE(), {$_SESSION['identity']->idrestaurante})";
    $saved = $this->db->query($sql);
    $result = false;
    if ($saved) {
      $result = true;
    }
    return $result;
  }
}
