<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include $routesPath;
    }

    public function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run()
    {
        $uri = self::getURI();

        foreach ($this->routes as $alias => $path) {
            if (preg_match("~$alias~", $uri)) {
                $internalRoute = preg_replace("~$alias~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                $actionName = 'action' . ucfirst(array_shift($segments));

                $param = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))
                    include_once $controllerFile;

                $controllerObj = new $controllerName;

                $result = call_user_func_array(array($controllerObj, $actionName), $param);

                if ($result)
                    break;
            }
        }
    }
}