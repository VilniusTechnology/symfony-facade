<?php namespace VilniusTechnology\SymfonysFacade\Services\Symfony;

use Illuminate\Support\Facades\App;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyContainer  {

    /** @var ContainerInterface  */
    private $container;

    /**
     * Load Symfonys kernel, from configuration.
     */
    public function __construct()
    {
        $kernel = new SymfonyKernel(App::environment(), true);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getSymfonyService($id)
    {
        return $this->container->get($id);
    }

}
