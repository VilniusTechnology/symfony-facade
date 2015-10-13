<?php namespace VilniusTechnology\SymfonysFacade\Controllers;

/*
 * Created by PhpStorm.
 * User: lukasm
 * Date: 15-06-03
 * Time: 14:26
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ONGR\ElasticsearchBundle\ORM\Manager;
use VilniusTechnology\SymfonysFacade\Services\Symfony\SymfonyContainer;

class ManagerController extends Controller
{
    private $manager;

    private $ssc;

    public function interpreter()
    {
        return view('SymfonysFacade::global');
    }

    public function run(Request $request, SymfonyContainer $sc)
    {
        $this->ssc = $sc;

        /** @var Manager $manager */
        $this->manager = $this->ssc->getSymfonyService('es.manager');

        $input = $request->all();
        $this->ssc->runCommand($input['command']);

        return view('SymfonysFacade::global');
    }
}