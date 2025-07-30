@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
  <h3 class="text-center">เข้าสู่ระบบ</h3>

  @if ($errors->any())
  <div class="alert alert-danger text-center">
    {{ $errors->first() }}
  </div>
  @endif

  @if (session('msg'))
  <div class="alert alert-info text-center">
    {{ session('msg') }}
  </div>
  @endif

  @if (session('success_msg'))
  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    {{ session('success_msg') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <form method="POST" action="/login">
    @csrf
    <div class="mb-2">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-2">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>

  <div class="mt-3 text-center">
    <a href="/reset-password">ลืมรหัสผ่าน?</a>
  </div>

  <hr>
  <p class="text-center">ยังไม่มีบัญชี? <a href="/register">สมัครสมาชิก</a></p>
</div>
@endsection