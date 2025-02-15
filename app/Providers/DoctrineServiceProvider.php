<?php

namespace App\Providers;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Illuminate\Support\ServiceProvider;

class DoctrineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EntityManager::class, function ($app) {
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [__DIR__ . '/../app/Entities'],
                isDevMode: true
            );

            $connection = DriverManager::getConnection([
                'driver' => 'pdo_mysql',
                'dbname' => env('DB_DATABASE'),
                'user' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
            ], $config);

            return new EntityManager($connection, $config);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
