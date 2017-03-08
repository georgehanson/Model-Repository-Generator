<?php

namespace GeorgeHanson\ModelRepositoryGenerator\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use GeorgeHanson\ModelRepositoryGenerator\Contracts\GeneratorContract;

class GenerateModel extends GeneratorCommand implements GeneratorContract
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class with a repository and contracts.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $model = parent::fire()) {
            return;
        }

        $contract = Str::studly(class_basename($this->argument('name')));

        $this->call('generate:contract', [
            'name' => "Models\\{$contract}",
        ]);

        if ($this->option('repository')) {
            $repository = Str::studly(class_basename($this->argument('name')));

            $this->call('generate:repository', [
                'name' => "$repository",
                'model' => $model
            ]);
        }

        if ($this->option('migration')) {
            $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

            $this->call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
            ]);
        }

        if ($this->option('controller')) {
            $controller = Str::studly(class_basename($this->argument('name')));

            $this->call('make:controller', [
                'name' => "{$controller}Controller",
                '--resource' => $this->option('resource'),
            ]);
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/model.stub';
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
        return config('modelrepositorygenerator.model.namespace');;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],

            ['repository', 'R', InputOption::VALUE_NONE, 'Create a new repository for the model.'],
        ];
    }
}
