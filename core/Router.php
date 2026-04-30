<?php

class Router {
    private $getRoutes = [];
    private $postRoutes = [];

    public function get($url, $file) {
        $this->getRoutes[$url] = $file;
    }

    public function post($url, $action) {
        $this->postRoutes[$url] = $action;
    }

    public function dispatch($request) {
        $request = trim($request, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = ($method === 'POST') ? $this->postRoutes : $this->getRoutes;

        foreach ($routes as $route => $target) {
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $request, $matches)) {
                array_shift($matches);

                // 🔥 NEW: support controller@method
                if (strpos($target, '@') !== false) {
                    list($controller, $method) = explode('@', $target);

                    require $controller . '.php';
                    $controllerClass = basename($controller);
                    $instance = new $controllerClass();

                    call_user_func_array([$instance, $method], $matches);
                } else {
                    require $target; // fallback (views)
                }

                return;
            }
        }

        http_response_code(404);
        echo '<div class="alert alert-dark w-100 h-100 text-center">
                <h1 class="text-danger" style="font-size: 7rem;">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                </h1>
                <h1 class="text-dark">
                    404 not found! <a href="/ams"><br/>Click here to return your page!</a>
                </h1>
            </div>';
        
    }
}