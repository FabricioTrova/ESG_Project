<?php
// ESG_Project/public/index.php
//esta armazenando o arquivo routes.php para dentro de uma variavel
$routes = require_once '../App/config/routes.php';

// Obtem o caminho da URL
$request = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($request);
$path = rtrim($parsedUrl['path'], '/');

// Verifica se a rota existe
if (array_key_exists($path, $routes)) {
    $view = $routes[$path];
    require_once "../App/views/{$view}.php";
} else {
    http_response_code(404);
    echo "Página não encontrada!";
}