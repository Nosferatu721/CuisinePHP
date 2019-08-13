<?php

function autoloadController($className)
{
  require_once 'controllers/' . $className . '.php';
}

spl_autoload_register('autoloadController');
