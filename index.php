<?php

require './vendor/autoload.php';
require './modelos/Jwt.php';

use \modelos\Jwt;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    exit;
}   

error_reporting(0);

header('Content-Type: application/json');

// Obtener la URL solicitada y el método HTTP
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Definir las rutas de la API
require_once 'rutas.php';

// Buscar la ruta y el controlador correspondiente
$found = false;

foreach ($routes[$requestMethod] as $route => $handler) {
    if (preg_match('#^' . $route . '$#', $requestUri, $matches)) {
        $found = true;
        array_shift($matches); // Eliminar el primer elemento que es la cadena completa coincidente

        list($controller, $method, $authorized) = explode('@', $handler);

        //Verificar si la ruta requiere autorización
        if ($authorized !== null) {
        
            // Validar el JWT del encabezado Authorization
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

            if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $tokenMatch)) {
                http_response_code(401);
                echo json_encode([
                    'message' => '401 Unauthorized'
                ]);
                exit;
            }

            try {

                $jwt = new Jwt($_ENV["SECRET_KEY"]);

                $jwt->decode($tokenMatch[1]);
    
            } catch (Exception $e) {
    
                http_response_code(401);
                echo json_encode(["message" => $e->getMessage() ]);
                exit();
            }
        }

        // Incluir el controlador dinámicamente
        $controllerFile = './controladores/' . $controller . '.php';

        if (file_exists($controllerFile)) {
            include $controllerFile;
        } else {
            http_response_code(500);
            echo "500 Internal Server Error: Controller not found.";
            exit;
        }

        $controller = 'controladores\\' . $controller;

        $requestData = json_decode(file_get_contents('php://input'), true);

        $controller = new $controller();
        echo $controller->$method($requestData, ...$matches);
        break;
    }
}

if (!$found) {
    // Ruta no encontrada
    http_response_code(404);
    echo "404 Not Found";
}
