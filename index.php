<?php


header('Content-Type: application/json');

// Obtener la URL solicitada y el método HTTP
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Definir rutas y controladores
$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UsuariosControlador@show', // Ruta con parámetro de ID
    ],
    'POST' => [
        '/users/create' => 'UserController@create',
    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
    ],
];

// Buscar la ruta y el controlador correspondiente
$found = false;

foreach ($routes[$requestMethod] as $route => $handler) {
    if (preg_match('#^' . $route . '$#', $requestUri, $matches)) {
        $found = true;
        array_shift($matches); // Eliminar el primer elemento que es la cadena completa coincidente

        list($controller, $method) = explode('@', $handler);

        /* Verificar si la ruta requiere autorización
        if (strpos($method, 'authorized') !== false) {
            // Eliminar el marcador @authorized del método
            $method = str_replace('@authorized', '', $method);

            // Validar el JWT del encabezado Authorization
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $tokenMatch)) {
                http_response_code(401);
                echo "401 Unauthorized";
                exit;
            }
            $jwt = $tokenMatch[1];
            if (!validateJWT($jwt)) {
                http_response_code(401);
                echo "401 Unauthorized";
                exit;
            }
        }*/

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

        $controller = new $controller();
        echo $controller->$method(...$matches);
        break;
    }
}

if (!$found) {
    // Ruta no encontrada
    http_response_code(404);
    echo "404 Not Found";
}
