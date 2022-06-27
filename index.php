<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

require_once './autoload.php';
require_once './Controllers/Controllers.php';

$controller = $_GET['controller'] ?? $_POST['controller'];
$funcao = $_GET['funcao'] ?? $_POST['funcao'];

if ($controller || $funcao) {
    require_once "Controllers/$controller.php";
}
