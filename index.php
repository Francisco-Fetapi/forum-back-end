<?php
require_once './autoload.php';
require_once './Controllers/Controllers.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");

$controller = $_GET['controller'] ?? $_POST['controller'];
$funcao = $_GET['funcao'] ?? $_POST['funcao'];

if ($controller || $funcao) {
    require_once "/app/Controllers/$controller.php";
} else {
    echo "Forum - Pagina Inicial";
}
