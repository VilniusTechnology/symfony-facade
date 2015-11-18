<?php

namespace VilniusTechnology\SymfonysFacade\Facades\Commands;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use VilniusTechnology\SymfonysFacade\Services\Symfony\SymfonyKernel;

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */

class SymfonyCommandsFacade
{
    public function __construct($container)
    {
        $this->container = $container->getContainer();
    }

    public function runCommand($command)
    {
        /** @var SymfonyKernel $kernel */
        $kernel = $this->container->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $output = new StreamOutput(fopen('php://temp', 'w'));

        $input = new StringInput($command);

        $application->run($input, $output);

        rewind($output->getStream());
        $response = stream_get_contents($output->getStream());

        return $response;
    }
}
