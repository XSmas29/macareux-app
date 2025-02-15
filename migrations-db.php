<?php

use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return DriverManager::getConnection([
    'dbname' => env('DB_DATABASE'),
    'user' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD', ''),
    'host' => env('DB_HOST'),
    'driver' => env('DB_CONNECTION'),
]);
