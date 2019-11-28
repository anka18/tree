<?php



class Router
{
    private $db;

    private $routes = array(
      'GET' => array(),
      'POST' => array(),
      'PUT' => array(),
      'DELETE' => array(),
    );

    function __construct($db) {
        $this->db = $db;
    }

    function get($name, $callback) {        // запоминаем url и связанную с ним функцию
        $this->routes["GET"][$name] = $callback;
    }

    function post($name, $callback)
    {
        $this->routes["POST"][$name] = $callback;
    }

    function put($name, $callback)
    {
        $this->routes["PUT"][$name] = $callback;
    }

    function delete($name, $callback)
    {
        $this->routes["DELETE"][$name] = $callback;
    }

    function do()
    {
        //header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Origin: http://127.0.0.1:3000/', false);
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
        header('Content-Type: application/json');

        // Получаем путь из url
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        error_log($_SERVER['REQUEST_METHOD'] . "  " . $path, 0);

        if (strcmp($_SERVER['REQUEST_METHOD'], 'OPTIONS') == 0) {
            // разрешаем метод options, ничего не делаем
        } else {
            // Берем все зареганные калбеки для HTTP метода
            $callbacks = $this->routes[$_SERVER['REQUEST_METHOD']];
            // Проверяем, есть ли для url путь
            if (array_key_exists($path, $callbacks) == true) {
                // получаем данные
                $data = array();
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'PUT':
                    case 'POST':
                    case 'DELETE':
                        $json_str = file_get_contents('php://input');
                        $data = json_decode($json_str, true);
                        break;
                }
                $callback = $callbacks[$path];
                $retval = $callback($this->db, $data);
                echo $retval;
            } else {
                header("HTTP/1.1 404 Not Found");
            }
        }
    }
}
