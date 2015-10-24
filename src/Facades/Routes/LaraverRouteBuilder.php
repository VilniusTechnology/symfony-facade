<?php namespace VilniusTechnology\SymfonysFacade\Facades\Routes;

/*
 * Created by PhpStorm.
 * User: lukasm
 * Date: 15-06-03
 * Time: 14:26
 */

class LaraverRouteBuilder
{

    public $prefix = 'VilniusTechnology\SymfonysFacade\Controllers\FacadeController@';

    private $routes;

    public function convertRoutes($routes)
    {
        $return = [];
        foreach ($routes as  $name => $route) {
            $action = null;
            if (isset($this->getTransformedController($route)[2] )) {
                // Usual Controller.
                $bundle = $controller = $this->getTransformedController($route)[0];
                $controller = $this->getTransformedController($route)[1];
                $action = $this->getTransformedController($route)[2];
            } else {
                // Controller as a service.
                $bundle = 'service';
                $controller = $this->getTransformedController($route)[0];
                $action = $this->getTransformedController($route)[1];
            }

            $trr['action']['controller'] =  $this->prefix . $controller . $action;
            $trr['action']['as'] = $name;
            $trr['action']['uses'] =  $this->prefix . $controller . ':' .  $action;

//            $trr['action']['namespace'] =  'todo';
//            $trr['action']['prefix'] =  'todo';
//            $trr['action']['where'] =  'todo';


            $trr["symfony_bundle"] = $bundle;
            $trr["symfony_action"] = $action;
            $trr["symfony_service"] = $action;
            $trr["symfony_route_name"] = $name;
            $trr["symfony_controller"] = $controller;

            $trr["_controller"] = $route->getDefaults()["_controller"];
            $trr['methods'] = $this->transformMethods($route);
            $trr['path'] = $route->getPath();
            $trr['name'] = $name;

            $return[] = $trr;
        }

        $this->routes = $return;

        return $return;
    }

    private function getTransformedController($route)
    {
        $controllerDirty = explode(':', $route->getDefaults()["_controller"]);

        return $controllerDirty;
    }

    private function transformMethods($route)
    {
        $methods = $route->getMethods();
        if (count($methods) < 1) {
            $methods = ['get', 'post'];
        }

        return $methods;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
