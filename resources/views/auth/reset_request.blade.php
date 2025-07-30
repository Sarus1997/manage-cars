@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 500px;">
  <h3 class="text-center">ตั้งรหัสผ่านใหม่</h3>

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

  <form method="POST" action="/reset-password">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">อีเมล</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required>
    </div>

    <div class="mb-3">
      <label for="new_password" class="form-label">รหัสผ่านใหม่</label>
      <input type="password" name="new_password" id="new_password" class="form-control" placeholder="ตั้งรหัสผ่านใหม่" required>
    </div>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-warning">ตั้งรหัสผ่านใหม่</button>
    </div>
  </form>

  <div class="mt-3 text-center">
    <a href="/login">← ย้อนกลับเข้าสู่ระบบ</a>
  </div>
</div>
@endsection
