<?php namespace VilniusTechnology\SymfonysFacade\Facades\Commands;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
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
//        $kernel->appDir = base_path();
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $output = new StreamOutput(fopen('php://temp', 'w'));
        $input = new ArrayInput(
            $this->prepareArguments($command)
        );

        $application->run($input, $output);

        rewind($output->getStream());
        $response = stream_get_contents($output->getStream());

        return $response;
    }

    private function prepareArguments($command)
    {
        $params = preg_split('/\\s/', $command);
        $commandName = $params[0];
        unset($params[0]);

        $paramReady = [];
        $i = 1;
        foreach ($params as $param) {
            if(isset($params[$i + 1]) && strstr($params[$i + 1], '--') !== false ) {
                $paramReady[$param] = '';
            } else {
                if (isset($params[$i]) && isset($params[$i + 1]) && strstr($params[$i], '--') !== false) {
                    $paramReady[trim($param, "--")] = $params[$i + 1];
                    unset($params[$i + 1]);
                    ++$i;
                }
            }
            ++$i;
        }
        array_unshift($paramReady, $commandName);

        return $paramReady;
    }
}
