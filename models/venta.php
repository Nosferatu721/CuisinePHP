<?php

class Venta
{
  private $db;
  private $idVenta;
  private $fechaVenta;
  private $idRestaurante;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  function getIdVenta()
  {
    return $this->idVenta;
  }
  function setIdVenta($idVenta)
  {
    $this->idVenta = $idVenta;
  }

  // GET - SET Nombre
  function getFechaVenta()
  {
    return $this->fechaVenta;
  }
  function setFechaVenta($fechaVenta)
  {
    $this->fechaVenta = $this->db->real_escape_string($fechaVenta);
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
  public function find()
  {
    // Crear Sentencia
    $sql = "SELECT idventa, fechaVenta, (SELECT count(*) FROM venta_has_producto WHERE idventa = venta_has_producto.venta_idventa) AS PVendidos FROM venta WHERE restaurante_idrestaurante = {$_SESSION['identity']->idrestaurante}";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Pedido por ID
  public function findVentaID()
  {
    $sql = "SELECT * FROM venta WHERE id={$this->getIdVenta()}";
    $Venta = $this->db->query($sql);
    return $Venta->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO venta VALUES (NULL, CURDATE(),{$_SESSION['identity']->idrestaurante})";
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
    $sql = "UPDATE venta SET fechaVenta='{$this->getFechaVenta()}', restaurante_idrestaurante={$_SESSION['identity']->Idrestaurante} WHERE idventa={$this->idVenta}";
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
    $sql = "DELETE FROM venta WHERE idventa = '{$this->idVenta}'";
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
    $sql = "CALL findProFec('$fechaInicial', '$fechaFinal',{$_SESSION['identity']->idrestaurante})";
    $result = $this->db->query($sql);
    return $result;
  }
}
