<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
  /**
   * Handle an incoming request.
   */
  public function handle(Request $request, Closure $next): Response
  {
    $user = Session::get('user');

    if (!$user || $user['role'] !== 'admin') {
      return redirect('/dashboard')->withErrors(['คุณไม่มีสิทธิ์เข้าถึงหน้านี้']);
    }

    return $next($request);
  }
}
