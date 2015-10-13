<?php namespace VilniusTechnology\SymfonysFacade\Commands;

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use VilniusTechnology\SymfonysFacade\Facades\Commands\SymfonyCommandsFacade;

class SymfonyCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'symfony:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute Symfony command';

    /**
     * Create a new command instance.
     *
     * @param SymfonyCommandsFacade $symfonyCommandsFacade
     */
    public function __construct(SymfonyCommandsFacade $symfonyCommandsFacade)
    {
        parent::__construct();

        $this->scf = $symfonyCommandsFacade;
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $response = $this->scf->runCommand($this->argument('scommand'));

        $this->info('');
        $this->info('Symfony responds: ');
        $this->info('');
        $this->info($response);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['scommand', InputArgument::REQUIRED, 'Enter symfonys command.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
