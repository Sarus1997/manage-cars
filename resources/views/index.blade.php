<div class="card">
  <div class="card-header">
    ยินดีต้อนรับ {{ session('user')['name'] }}
  </div>
  <div class="card-body">
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><a href="/cars">จัดการคลังรถ</a></li>
      <li class="list-group-item"><a href="/loan">คำนวณยอดผ่อน</a></li>
      @if(session('user')['role'] === 'admin')
      <li class="list-group-item"><a href="/admin/users">จัดการผู้ใช้</a></li>
      @endif
      <li class="list-group-item"><a href="/logout">Logout</a></li>
    </ul>
  </div>
</div>