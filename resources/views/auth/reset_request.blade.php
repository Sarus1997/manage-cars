@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 500px;">
  <h3 class="text-center">รีเซตรหัสผ่าน</h3>

  @if ($errors->any())
  <div class="alert alert-danger">
    {{ $errors->first() }}
  </div>
  @endif

  @if (session('msg'))
  <div class="alert alert-info">
    {{ session('msg') }}
  </div>
  @endif

  <form method="POST" action="/reset-password">
    @csrf
    <div class="mb-3">
      <label class="form-label">อีเมล</label>
      <input type="email" name="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required>
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-warning">รีเซตรหัสผ่าน</button>
    </div>
  </form>
</div>
@endsection
