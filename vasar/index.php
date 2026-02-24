<?php

// Простой роутер для vasar
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Определяем базовый путь
$basePath = '/vasar';

// Убираем базовый путь из URI
$path = str_replace($basePath, '', $requestUri);
$path = $path ?: '/';

// Обработка API запросов
if ($path === '/api/download' && $method === 'POST') {
    require __DIR__ . '/app/Http/Controllers/TikTokController.php';
    $controller = new \App\Http\Controllers\TikTokController();
    $controller->download();
    exit;
}

// Обработка preflight CORS запросов
if ($path === '/api/download' && $method === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(200);
    exit;
}

// Главная страница
if ($path === '/' || $path === '') {
    require __DIR__ . '/resources/views/welcome.php';
    exit;
}

// Проверка системы
if ($path === '/check.php' || $path === '/check') {
    if ($path === '/check') {
        header("Location: $basePath/check.php");
        exit;
    }
    require __DIR__ . '/check.php';
    exit;
}

// Для всех остальных путей - возвращаем главную страницу (SPA)
require __DIR__ . '/resources/views/welcome.php';
