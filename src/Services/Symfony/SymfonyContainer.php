<?php namespace VilniusTechnology\SymfonysFacade\Services\Symfony;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Symfony\Bundle\AsseticBundle\Command\DumpCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\HttpKernel\KernelInterface;

class SymfonyContainer  {

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
