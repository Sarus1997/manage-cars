<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    // ลงทะเบียน middleware aliases สำหรับ Laravel 12
    $middleware->alias([
      'auth.custom' => \App\Http\Middleware\CustomAuth::class,
      'admin.only' => \App\Http\Middleware\AdminOnly::class,
    ]);

    // เพิ่ม middleware ใน web group หากจำเป็น
    $middleware->web(append: [
      // middleware อื่นๆ ที่ต้องการ
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
