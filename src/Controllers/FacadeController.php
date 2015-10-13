<?php namespace VilniusTechnology\SymfonysFacade\Controllers;

/*
 * Created by PhpStorm.
 * User: lukasm
 * Date: 15-06-03
 * Time: 14:26
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use VilniusTechnology\SymfonysFacade\Facades\Routes\SymfonyRoutesManager;
use VilniusTechnology\SymfonysFacade\Services\Symfony\SymfonyContainer;

class FacadeController extends Controller
{
    public function __construct(SymfonyRoutesManager $srm, SymfonyContainer $sc, Request $request)
    {
        $this->symfonyRoutesManager = $srm;
        $this->symfonyContainer = $sc;
        $this->request = $request;
    }

    public function __call($name, $arguments)
    {
        foreach ($this->symfonyRoutesManager->getConvertedRoutes() as $route) {
            if ($route['action'] == $this->symfonyRoutesManager->prefix . $name ) {
                $actionMethodName = $route["symfony_action"];
                $controllerClass = $route["symfony_bundle"];

                $controllerObj = new $controllerClass();
                $controllerObj->setContainer($this->symfonyContainer->getContainer());
                $response = $controllerObj->$actionMethodName(Request::createFromGlobals());

                echo $response;
            }
        }
    }
}
