<?php

namespace TeldsShop\App;

class Routing
{
    CONST ROUTER_LABEL = 'routes';
    CONST METHOD_LABEL = 'method';
    CONST ACTION_NAME = 'actionName';
    CONST CLASS_NAME = 'className';

    public static array $routes = [];
    public static int $urlIdPaths = 0;


    /**
     * @param string $routes
     * @param string $method
     * @param string $className
     * @param string $actionName
     * @return void
     * This defines the routing path
     */
    public static function path(string $routes, string $method, string $className, string $actionName): void
    {
        $route = str_replace("{id}", '(.*)', $routes);
        $indexName = md5($method . $route);
        if(!array_key_exists($indexName, self::$routes)){
            self::$routes[$indexName] = [
                self::ROUTER_LABEL => $routes,
                self::METHOD_LABEL => $method,
                self::CLASS_NAME => $className,
                self::ACTION_NAME => $actionName
            ];
        }
    }

    /**
     * @return void
     */
    public static function executePath(): void
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $route = strtolower($_SERVER['REQUEST_URI']);

        $indexName = md5($method . $route);
        if(array_key_exists($indexName, self::$routes)){
            self::controllerMethodsWithAction($indexName);
        } else {
            foreach (self::$routes as $index => $routeToCheck) {
                $routeRexExp = "/" . str_replace("/", "\/", $routeToCheck[self::ROUTER_LABEL]) . "/m";
                preg_match_all($routeRexExp, $route, $matches);
                if (!empty($matches)) {
                    $id = $matches[1][0] ?? 0;
                    $id = (int)$id;
                    if ($id != 0) {
                        $routeReplaced = str_replace($id, '(.*)', $route);
                        $indexToCheck = md5($method . $routeReplaced);
                        if($indexToCheck == $index){
                            self::$urlIdPaths = $id;
                            self::ControllerMethodsWithAction($index);
                            return;
                        }
                    }
                }
            }
        }
    }

    private static function controllerMethodsWithAction(string $indexName): void
    {
        $classNameSpace = self::$routes[$indexName][self::CLASS_NAME];
        $action = self::$routes[$indexName][self::ACTION_NAME];
        if(class_exists($classNameSpace)){
            $viewObject = self::getViewObject();
            $object = new $classNameSpace($viewObject);
            $object->{$action . "Action"}();
        }
    }

    private static function getViewObject(): View
    {
        $view = NATIVE;
        foreach (LIST_OF_TEMPLATE_ENGINES as $templateEngine => $activeTemplateEngine){
            if($activeTemplateEngine){
                $view = $templateEngine;
            }
        }
        return match ($view){
            TWIG => new viewTwig(),
            default => new view(),
        };
    }

}
