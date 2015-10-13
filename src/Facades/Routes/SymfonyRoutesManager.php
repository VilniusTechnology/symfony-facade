<?php namespace VilniusTechnology\SymfonysFacade\Facades\Routes;

use Illuminate\Routing\Router;
use Symfony\Component\Routing\Route;
use VilniusTechnology\SymfonysFacade\Services\Symfony\SymfonyContainer;

class SymfonyRoutesManager
{

    private $routesFromSymfony;

    public function __construct(SymfonyContainer $sc, LaraverRouteBuilder $rb)
    {
        $this->sc = $sc;
        $this->rb = $rb;
        $this->prefix = $this->rb->prefix;

        $this->routesFromSymfony = $this->rb->convertRoutes($this->getRawRoutes());
    }

    public function addSymfonyRoutes(Router $router)
    {
        foreach ($this->routesFromSymfony as $route) {
            $router->match($route['methods'], $route['path'], $route['action']);
        }
    }

    public function getRawRoutes()
    {
        $availableApiRoutes = [];
        /** @var  $route Route */
        foreach ($this->sc->getSymfonyService('router')->getRouteCollection()->all() as $name => $route) {
            $availableApiRoutes[$name] = $route;
        }

        return $availableApiRoutes;
    }

    public function getConvertedRoutes()
    {
        return $this->routesFromSymfony;
    }
}
