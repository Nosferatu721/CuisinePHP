<?php

class DataBase
{
  public static function conectar()
  {
    // Crear Conexion
    $db = new mysqli('localhost', 'root', '', 'cuisinesoft1.0');
    // Admitir Ñ y tildes de la Base de Datos
    $db->query("SET NAMES 'utf8'");
    return $db;
  }
}