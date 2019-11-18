<?php

class VentaHP
{
  private $db;
  private $idVenta;
  private $idProducto;
  private $cantVend;
  private $cantProy;
  private $fechaProy;


  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET Id venta
  function getIdVenta()
  {
    return $this->idVenta;
  }
  function setIdVenta($idVenta)
  {
    $this->idVenta = $idVenta;
  }

  // GET - SET id Producto
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }

   // GET - SET Cantidad producto
  function getCantVend()
  {
    return $this->cantVend;
  }
  function setCantVend($cantVend)
  {
    $this->cantVend = $this->db->real_escape_string($cantVend);
  }
  //SET y GET cantidad proyectada
  function getCantProy()
  {
    return $this->cantProy;
  }
  function setCantProy($cantProy)
  {
    $this->cantProy = $this->db->real_escape_string($cantProy);
  }
  //SET y GET fecha proyectada
  function getFechaProy()
  {
    return $this->fechaProy;
  }
  function setFechaProy($FechaProy)
  {
    $this->FechaProy = $this->db->real_escape_string($fechaProy);
  }

  // Consultar Todos Los Restaurantes
  public function find()
  {
    // Crear Sentencia
  $sql = "SELECT * FROM venta_has_producto INNER JOIN producto ON producto_idproducto = idproducto WHERE venta_idventa = {$this->getIdVenta()}";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

//   // Consultar Pedido por ID
//   public function findID()
//   {
//     $sql = "SELECT * FROM venta WHERE id={$this->getIdVenta()}";
//     $Venta = $this->db->query($sql);
//     return $Venta->fetch_object();
//   }

  //Registrar
  public function save()
  {
    $sql = "CALL insertUpdatevenHP ({$this->getIdVenta()},
  {$this->getIdProducto()},{$this->getCantVend()})";
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
    $sql = "UPDATE venta_has_producto SET producto_idproducto='{$this->getIdProducto()}', cantidadVendida={$this->cantVend()} WHERE venta_idventa={$this->idVenta()}";
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
  $sql = "CALL deleteUpdvenHP ({$this->getIDVenta()},{$this->getIdProducto()})";
  $delete = $this->db->query($sql);
  $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
  //TODO: Crear Procedimiento base de datos
  // Consulta Por Fecha
  public function findForDate($fechaInicial, $fechaFinal)
  {
    $sql = "CALL findMermaDATE({$_SESSION['identity']->idrestaurante}, '$fechaInicial', '$fechaFinal')";
    $result = $this->db->query($sql);
    return $result;
  }
}
