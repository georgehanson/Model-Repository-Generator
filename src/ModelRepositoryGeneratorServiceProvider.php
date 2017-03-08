<?php

namespace GeorgeHanson\ModelRepositoryGenerator;

use GeorgeHanson\ModelRepositoryGenerator\Console\GenerateContract;
use GeorgeHanson\ModelRepositoryGenerator\Console\GenerateModel;
use GeorgeHanson\ModelRepositoryGenerator\Console\GenerateRepository;
use Illuminate\Support\ServiceProvider;

class ModelRepositoryGeneratorServiceProvider extends ServiceProvider
{
    protected $consoleCommands = [
        GenerateContract::class,
        GenerateModel::class,
        GenerateRepository::class
    ];

    /**
     * Register the services
     */
    public function register()
    {
        $this->commands($this->consoleCommands);
    }

    /**
     *
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/modelrepositorygenerator.php' => config_path('modelrepositorygenerator.php'),
        ]);
    }
}