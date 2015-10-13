<?php namespace VilniusTechnology\SymfonysFacade\Services\Symfony;

use Illuminate\Support\Facades\Config;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class SymfonyKernel extends Kernel
{

    public $appDir;

    public function __construct($env, $debug)
    {
        parent::__construct($env, $debug);

        // Set Symfony app dir.
        $this->appDir = __DIR__;
        $appDir = Config::get('app.symfonysfacade_app_dir');
        if (isset($appDir)) {
            $this->appDir = base_path() . $appDir;
        }

//        //Set Symfony log dir.
//        $this->logDir = $this->appDir;
//        $logDir = Config::get('app.symfonysfacade_log_dir');
//        if (isset($logDir)) {
//            $this->logDir = base_path() . $logDir;
//        }

    }
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SecurityBundle(),
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
        //TODO: do proper loading
        return realpath(parent::getRootDir().'/../Symfony');
    }

    public function getCacheDir()
    {
        return $this->appDir . '/' . $this->environment . '/cache';
    }

    public function getLogDir()
    {
        return $this->appDir . '/' . $this->environment . '/logs';
    }

    private function getBundlesFromConfig()
    {
        $bundleProvider = Config::get('app.symfonysfacade_bundles');

        return $bundleProvider::getBundles();
    }
}
