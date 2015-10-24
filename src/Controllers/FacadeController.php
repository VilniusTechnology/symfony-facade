<?php namespace VilniusTechnology\SymfonysFacade\Controllers;

/*
 * Created by PhpStorm.
 * User: lukasm
 * Date: 15-06-03
 * Time: 14:26
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response;
use VilniusTechnology\SymfonysFacade\Facades\Routes\SymfonyRoutesManager;
use VilniusTechnology\SymfonysFacade\Services\Symfony\SymfonyContainer;

class FacadeController extends Controller
{
    public function __construct(
        SymfonyRoutesManager $symfonyRoutesManager,
        SymfonyContainer $symfonyContainer,
        Request $request
    ) {
        $this->symfonyRoutesManager = $symfonyRoutesManager;
        $this->symfonyContainer = $symfonyContainer;
        $this->request = $request;
    }

    public function __call($target, $arguments)
    {
        $symfonyRoutes = $this->symfonyRoutesManager->getConvertedRoutes();
        foreach ($symfonyRoutes as $route) {
            $current = $route['symfony_controller'] . ':' . $route['symfony_action'];
            if ($current == $target ) {

                if (strstr($target, '.') !== false) {
                    //Route as a service, dispatch from container.
                    $controllersService = $this->symfonyContainer->getSymfonyService($route['symfony_controller']);
                    $actionMethodName = $route['symfony_action'];

                    $params = Request::createFromGlobals();

                    //@TODO: params passing should be fixed blemba...
                    /** @var Response $response */
                    $response = $controllersService->$actionMethodName($this->convertRequest(), 'fos.Router.setData');

                    if ($response instanceof Response) {
                        $content = $response->getContent();
                    } else {
                        $content = $response;
                    }

                    return $content;
                }

                $actionMethodName = $route["symfony_action"];
                $controllerClass = $route["symfony_controller"];

                $controllerObj = new $controllerClass();
                $controllerObj->setContainer($this->symfonyContainer->getContainer());
                $response = $controllerObj->$actionMethodName(Request::createFromGlobals());

                return $response;
            }
        }
    }

    private function convertRequest()
    {
        return new SymfonyRequest($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER, '');
    }
}
