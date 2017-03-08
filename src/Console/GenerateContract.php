<?php

namespace GeorgeHanson\ModelRepositoryGenerator\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use GeorgeHanson\ModelRepositoryGenerator\Contracts\GeneratorContract;

class GenerateContract extends GeneratorCommand implements GeneratorContract
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (parent::fire() === false) {
            return;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/contract.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the namespace for where to store the new class
     *
     * @return string
     */
    public function getClassNamespace()
    {
        return config('modelrepositorygenerator.contract.namespace');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }
}
