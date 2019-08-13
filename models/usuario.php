<?php

class Usuario
{
  private $db;
  private $id;
  private $nombre;
  private $apellido;
  private $pass;
  private $cargo;
  private $restaurante;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }

  // Get and Set
  function getId()
  {
    return $this->id;
  }
  function setId($id)
  {
    $this->id = $this->db->real_escape_string($id);
  }
  //
  function getNombre()
  {
    return $this->nombre;
  }
  function setNombre($nombre)
  {
    $this->nombre = $this->db->real_escape_string($nombre);
  }
  //
  function getApellido()
  {
    return $this->apellido;
  }
  function setApellido($apellido)
  {
    $this->apellido = $this->db->real_escape_string($apellido);
  }
  //
  function getPass()
  {
    return $this->pass;
  }
  function setPass($pass)
  {
    $this->pass = $this->db->real_escape_string($pass);
  }
  //
  function getCargo()
  {
    return $this->cargo;
  }
  function setCargo($cargo)
  {
    $this->cargo = $this->db->real_escape_string($cargo);
  }
  //
  function getRestaurante()
  {
    return $this->restaurante;
  }
  function setRestaurante($restaurante)
  {
    $this->restaurante = $this->db->real_escape_string($restaurante);
  }

  // Metodos
  public function login()
  {
    $result = false;
    $id = $this->id;
    $pass = $this->pass;

    // Comprovamos si existe el usuario
    $sql = "SELECT * FROM usuarios WHERE idusuarios = '$id'";
    $login = $this->db->query($sql);

    // Comprobamos si la consulta retorno el usuario
    if ($login && $login->num_rows == 1) {
      // Guardamos los datos en un Objeto
      $usuario = $login->fetch_object();

      if ($pass == $usuario->contrasena) {
        $result = $usuario;
      }
    } else {
      $result = "error consulta";
    }
    return $result;
  }
  // Consultar Usuarios
  public function findUsers()
  {
    $sql = "CALL findUsuarios()";
    $usuarios = $this->db->query($sql);
    return $usuarios;
  }
  // Consultar Usuario Por ID
  public function findUserID()
  {
    $sql = "SELECT * FROM usuarios WHERE idusuarios={$this->getId()}";
    $usuarios = $this->db->query($sql);
    return $usuarios->fetch_object();
  }
  // Guardar Usuario
  public function save()
  {
    // Registramos al Usuario
    $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getPass()}', '{$this->getCargo()}', '{$this->getRestaurante()}');";
    $save = $this->db->query($sql);

    // Verificamos que se ha registrado en la DB
    $result = false;
    if ($save) {
      $result = true;
    }

    return $result;
  }

  public function update()
  {
    $sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellido='{$this->getApellido()}', contrasena='{$this->getPass()}', cargo_idcargo='{$this->getCargo()}', restaurante_idrestaurante='{$this->getRestaurante()}' WHERE idusuarios='{$this->id}'";
    $update = $this->db->query($sql);
    $result = false;
    if ($update) {
      $result = true;
    }
    return $result;
  }

  // Eliminar Usuario
  public function delete()
  {
    // Eliminamos el usuario
    $sql = "DELETE FROM usuarios WHERE idusuarios={$this->getId()}";
    $del = $this->db->query($sql);

    // Verificar
    $result = false;
    if ($del) {
      $result = true;
    }

    return $result;
  }
}
