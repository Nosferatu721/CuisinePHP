<?php

function autoloadController($className)
{
  $r = file_exists('controllers/' . $className . '.php');
  if (!$r) {
    header('Location: ' . baseUrl . 'error/index');
  }
  require_once 'controllers/' . $className . '.php';
}

spl_autoload_register('autoloadController');
