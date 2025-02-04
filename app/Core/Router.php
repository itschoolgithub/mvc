<?php

namespace App\Core;

class Router {
    private string $controllerClass = 'App\Controllers\MainController';
    private string $method = 'indexAction';
    private Controller $controller;
    private array $parts = [];

    public function __construct() {
        $this->getUrlParts();
    }

    public function run(): void {
        // echo '<pre>';
        // print_r($this->parts);
        // echo '</pre>';

        $directory = '';
        $controller = array_shift($this->parts);
        if ($controller == 'admin') {
            if ($this->parts) {
                $directory .= 'Admin\\';
                $controller = array_shift($this->parts);
            }
        }

        $action = array_shift($this->parts);

        if ($this->parts) {
            $id = array_shift($this->parts);
            if (!is_numeric($id)) {
                self::error404();
            }
            $_GET['id'] = $id;
        }

        if ($controller) {
            $this->controllerClass = 'App\Controllers\\' . $directory .  ucfirst($controller) . 'Controller';
        }

        if (class_exists($this->controllerClass)) {
            $this->controller = new $this->controllerClass;

            if ($action) {
                $this->method = $action . 'Action';
            }

            if (method_exists($this->controller, $this->method)) {
                $this->controller->{$this->method}();
            } else {
                self::error404();
            }
        } else {
            self::error404();
        }
    }

    private function getUrlParts(): void {
        $url = $_SERVER['REQUEST_URI'];
        $url = parse_url($url);

        $this->parts = explode('/', trim($url['path'], '/'));
    }

    public static function error404(): void {
        header("HTTP/1.0 404 Not Found");
        echo 'Ошибка 404';
        die();
    }
}