<?php

// Autoload Composer
require __DIR__ . '/../vendor/autoload.php';

// Load Laravel App
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle HTTP request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
