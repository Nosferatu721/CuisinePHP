<?php

class ArchivoController
{
  private $db;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }

  public function gestion()
  {
    $sql = "SELECT idArchivo, descripcion, document, idUser, nombre, apellido FROM archivos INNER JOIN usuarios ON archivos.idUser = usuarios.idusuarios";
    $docs = $this->db->query($sql);
    require_once 'views/archivo/gestion.php';
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $idArc = $_GET['id'];
      $sql0 = "SELECT * FROM archivos WHERE idArchivo=$idArc AND idUser={$_SESSION['identity']->idusuarios}";
      $result0 = $this->db->query($sql0);
      $registro = mysqli_fetch_object($result0);
      if ($result0->num_rows == 0) {
        $_SESSION['delete'] = 'NoSePuede';
      } else {
        $sql = "DELETE FROM archivos WHERE idArchivo=$idArc AND idUser={$_SESSION['identity']->idusuarios}";
        $result = $this->db->query($sql);
        if ($result) {
          unlink('dist/public/' . $registro->document);
          $_SESSION['delete'] = 'Eliminado';
        } else {
          echo 'Error';
        }
      }
      header('Location: ' . baseUrl . 'archivo/gestion');
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  
  public function registrar()
  {
    if (isset($_POST) && !empty($_POST['descripcion'])) {
      $descripcion = $_POST['descripcion'];

      $file = $_FILES['archivo'];
      $name = $file['name'];
      $tipo = strtolower(pathinfo($name, PATHINFO_EXTENSION));

      $sql = "SELECT * FROM archivos";

      $result = $this->db->query($sql);

      if ($result) {
        $count = 0;
        while ($d = $result->fetch_object()) {
          if ($d->document == $name) {
            $count++;
          }
        }
        if ($count > 0) {
          $_SESSION['save'] = 'YaExiste';
          header('Location: ' . baseUrl . 'archivo/gestion');
        } else {
          if ($tipo == 'docx' || $tipo == 'doc' || $tipo == 'pdf') {
            if (!is_dir('dist')) {
              mkdir('dist/public', 0777, true);
            }
            move_uploaded_file($file['tmp_name'], 'dist/public/' . $name);

            $sql = "INSERT INTO archivos VALUES (NULL, '$descripcion', '$name', {$_SESSION['identity']->idusuarios})";

            $insert = $this->db->query($sql);
            if ($insert) {
              $_SESSION['save'] = 'Registrado';
              header('Location: ' . baseUrl . 'archivo/gestion');
            } else {
              echo 'Error';
            }
          } else {
            $_SESSION['save'] = 'NoAdmitido';
            header('Location: ' . baseUrl . 'archivo/gestion');
          }
        }
      } else {
        echo 'Yuca';
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
      header('Location: ' . baseUrl . 'archivo/gestion');
    }
  }
}
