<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => env_var('DB_DRIVER', 'mysql'),
    'host'      => env_var('DB_HOST', 'mysql'),
    'port'      => env_var('DB_PORT', 3306),
    'database'  => env_var('DB_DATABASE', 'pokedex'),
    'username'  => env_var('DB_USER', 'root'),
    'password'  => env_var('DB_PASSWORD', 'root'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->bootEloquent();
