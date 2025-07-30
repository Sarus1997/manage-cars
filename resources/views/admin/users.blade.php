@extends('layouts.app')

@section('content')
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="#">ระบบจัดการผู้ใช้งาน</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/dashboard">Dashboard</a>
        </li>
      </ul>
    </div>
  </nav>

  <h2>จัดการผู้ใช้งาน</h2>

  {{-- แสดงข้อความแจ้งเตือน --}}
  @if(session('msg'))
  <div class="alert alert-success">{{ session('msg') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>ชื่อ</th>
        <th>อีเมล</th>
        <th>สถานะ</th>
        <th>บทบาท</th>
        <th>การจัดการ</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $u)
      <tr>
        <td>{{ $u['id'] }}</td>
        <td>{{ $u['name'] }}</td>
        <td>{{ $u['email'] }}</td>
        <td>
          @if($u['status'] === 'active')
          <span class="badge bg-success">Active</span>
          @else
          <span class="badge bg-danger">Blocked</span>
          @endif
        </td>
        <td>{{ $u['role'] }}</td>
        <td>
          {{-- Reset Password --}}
          <form action="{{ url('/admin/users/reset/'.$u['id']) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-warning btn-sm" onclick="return confirm('Reset password ผู้ใช้นี้?')">
              Reset Password
            </button>
          </form>

          {{-- Block User --}}
          <form action="{{ url('/admin/users/block/'.$u['id']) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-danger btn-sm" onclick="return confirm('Block ผู้ใช้นี้?')">
              Block
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">ยังไม่มีผู้ใช้งาน</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">
    <a href="/dashboard" class="btn btn-secondary">← ย้อนกลับไปยัง Dashboard</a>
  </div>
</div>
@endsection