<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomAuth
{
  public function handle(Request $request, Closure $next)
  {
    $user = Session::get('user');

    if (!$user || $user['status'] !== 'active') {
      return redirect('/login')->withErrors(['กรุณาเข้าสู่ระบบก่อน']);
    }

    return $next($request);
  }
}
