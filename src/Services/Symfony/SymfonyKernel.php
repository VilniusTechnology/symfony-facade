<?php

namespace VilniusTechnology\SymfonysFacade\Services\Symfony;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class SymfonyKernel extends Kernel
{
    /**
     * Symfonys app dir.
     *
     * @var string
     */
    public $appDir;

    /**
     * Symfonys log dir.
     *
     * @var string
     */
    public $logDir;

    public function __construct($env, $debug)
    {
        // Set Symfony app dir.
        $appDir = config('app.symfonysfacade_app_dir');
        if (isset($appDir)) {
            $this->appDir =  base_path()  . '/'. $appDir . $env;
        } else {
            $this->appDir = base_path() . '/storage/app/symfony';
        }

        parent::__construct($env, $debug);

        //Set Symfony log dir.
        $logDir = config('app.symfonysfacade_log_dir');
        if (isset($logDir)) {
            $this->logDir = $logDir . $env;
        } else {
            $this->logDir = base_path() . '/storage/app/symfony/'. $env;
        }
    }

    /**
     * Register Symfony2 core bundles.
     *
     * @return array
     */
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new TwigBundle(),
        ];

        return array_merge($this->getBundlesFromConfig(), $bundles);
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->appDir . '/config/config.yml');
    }

    public function getRootDir()
    {
        return $this->appDir;
    }

    public function getCacheDir()
    {
        return $this->appDir . '/cache';
    }

    public function getLogDir()
    {
        return $this->appDir . '/logs';
    }

    private function getBundlesFromConfig()
    {
        $bundleProvider = config('app.symfonysfacade_bundles');
        if ($bundleProvider === null) {
            $bundleProvider = '\VilniusTechnology\SymfonyBundles';
        }

        return $bundleProvider::getBundles();
    }
}
