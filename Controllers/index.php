<?php
    require_once '../autoload.php';
    require_once './Controllers.php';

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin:*"); 

    $controller = $_GET['controller'] ?? $_POST['controller'];
    $funcao = $_GET['funcao'] ?? $_POST['funcao'];

    require_once "$controller.php";
   
?>