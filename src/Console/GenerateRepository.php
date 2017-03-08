<?php

namespace GeorgeHanson\ModelRepositoryGenerator\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use GeorgeHanson\ModelRepositoryGenerator\Contracts\GeneratorContract;

class GenerateRepository extends GeneratorCommand implements GeneratorContract
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:repository {name} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $repository = parent::fire()) {
            return;
        }

        $contract = Str::studly(class_basename($this->argument('name')));

        $this->call('generate:contract', [
            'name' => "Repositories\\{$contract}",
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/repository.stub';
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
        return config('modelrepositorygenerator.repository.namespace');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['model', InputArgument::REQUIRED, 'The model for the repository.'],
        ];
    }
}
