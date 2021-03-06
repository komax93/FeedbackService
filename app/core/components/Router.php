<?php

/**
 * Class Router
 * This class parses URI-address and returns required action-method from controller,
 * which contains necessary routes
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = APP_PATH . 'core/config/routes.php';
        $this->routes = require_once ($routesPath);
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'] . '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path)
        {
            if(preg_match("~$uriPattern~", $uri))
            {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)) . "Controller";
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;
                $controllerFile = APP_PATH . 'controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile))
                {
                    require_once ($controllerFile);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if($result != null)
                {
                    break;
                }
            }
        }
    }
}