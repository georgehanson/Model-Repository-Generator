# Model Repository Generator

***This package is archived***

This is a package for Laravel 5 which allows you to easily generate repositories, contracts and models. It brings two
new automatic file creation commands (Repositories and Contracts), as well as enhancing the current model creation
command.

## Installation
Once you have downloaded this package, you simply need to add the service provider to your `config/app.php` file. You
should add the following service provider:

```php
[
    ...
    GeorgeHanson\ModelRepositoryGenerator\ModelRepositoryGeneratorServiceProvider::class
    ...
]
```

Once you have added the package to your service provider, be sure to run `php artisan vendor:publish` to publish the
config file. Once this is done you can use this config file to change where you would like your models, repositories
and contracts to be stored. ***You do not need to include your main applications namespace.***

## Generating Contracts
Generating contracts is simple and easy. Simply run the following command: `php artisan generate:contract ContractName`.
Here you can set the contract name to whatever you would like.

## Generating Repositories
To generate a repository simply run the following command: `php artisan generate:repository Repository Model`. As you can
see the first argument this command takes the name of the repository and the second is the name of the model this repository
is for. This will also generate a contract for the repository and implement that contract on the newly created repository.

## Enhanced Model Generation
This package enhances the default model creation command which comes by default with Laravel. To generate a model you
 can simply run the following command: `php artisan generate:model Model`, replacing "Model" with the name of your choice.
 Not only will this create a model, it will also create a contract for this model and make the model implement the newly
 created contract.
 
 You can also automatically generate a repository by passing the `-R` flag. For example, `php artisan generate:model Model -R`.
 This will generate a model, a contract for that model, a repository for that model and a contract for the repository.
 
 You can also pass through the default flags which come out of the box with laravel such as `-m` to create a migration or `-c`
 to create a controller.
