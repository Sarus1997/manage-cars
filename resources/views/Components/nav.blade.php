<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand brand-logo" href="/">
      <i class="fas fa-car me-2"></i>ระบบจัดการรถยนต์
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/cars">
            <i class="fas fa-warehouse me-1"></i>คลังรถ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/loan">
            <i class="fas fa-calculator me-1"></i>คำนวณผ่อน
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i>{{ session('user')['name'] }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            @if(session('user')['role'] === 'admin')
            <li><a class="dropdown-item" href="/admin/users">
                <i class="fas fa-users-cog me-2"></i>จัดการผู้ใช้
              </a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            @endif
            <li><a class="dropdown-item text-danger" href="/logout">
                <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
              </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>