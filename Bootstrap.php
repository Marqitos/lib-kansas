<?php

namespace test;

use function error_reporting;
use function get_include_path;
use function ini_set;
use function realpath;
use function set_include_path;

// Mostramos todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 'stdout');

// Añadir directorio de librerias de código
set_include_path(
    __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . PATH_SEPARATOR .
    __DIR__ . DIRECTORY_SEPARATOR . PATH_SEPARATOR .
	get_include_path()
);