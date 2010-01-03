<?php

/** Configuración de Directorios */
$rootPath = dirname(__FILE__);

$paths = new ArrayObject();
$paths->append(get_include_path());
$paths->append($rootPath);
$paths->append($rootPath.'/library');
set_include_path(implode(PATH_SEPARATOR, $paths->getArrayCopy()));
require_once("Application.php");
Application::run();
?>