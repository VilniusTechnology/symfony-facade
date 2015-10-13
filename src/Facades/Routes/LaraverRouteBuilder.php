<?php namespace VilniusTechnology\SymfonysFacade\Facades\Routes;

/*
 * Created by PhpStorm.
 * User: lukasm
 * Date: 15-06-03
 * Time: 14:26
 */

class LaraverRouteBuilder {

    public $prefix = 'VilniusTechnology\SymfonysFacade\Controllers\FacadeController@';

    private $routes;

    public function convertRoutes($routes)
    {
        $return = [];
        foreach ($routes as  $name => $route) {
            $action = null;
            if (isset($this->getTransformedController($route)[2] )) {
                $action = $this->getTransformedController($route)[2] ;
            }

            $trr['action'] =  $this->prefix . $this->getTransformedController($route)[1] . ':' .  $action;
            $trr["symfony_bundle"] = $this->getTransformedController($route)[0];
            $trr["symfony_action"] = $action;
            $trr["_controller"] = $route->getDefaults()["_controller"];
            $trr["symfony_route_name"] = $name;
            $trr["symfony_controller"] =$this->getTransformedController($route)[1];
            $trr['methods'] = $this->transformMethods($route);
            $trr['path'] = $route->getPath();

            $return[] = $trr;
        }

        $this->routes = $return;

        return $return;
    }

    private function getTransformedController($route)
    {
        return explode(':', $route->getDefaults()["_controller"]);
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
