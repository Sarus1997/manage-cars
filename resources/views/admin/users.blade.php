@extends('layouts.app')

@section('content')
<style>
  .gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
  }

  .card-shadow {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 15px;
  }

  .navbar-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .table-custom {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  }

  .table-custom thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
  }

  .table-custom tbody tr {
    transition: all 0.3s ease;
  }

  .table-custom tbody tr:hover {
    background-color: #f8f9ff;
    transform: translateY(-1px);
  }

  .btn-custom {
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
  }

  .btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }

  .btn-reset {
    background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
    color: #2d3436;
  }

  .btn-block {
    background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
    color: white;
  }

  .btn-back {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
    color: white;
  }

  .status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.85em;
  }

  .status-active {
    background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
    color: white;
  }

  .status-blocked {
    background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
    color: white;
  }

  .page-title {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 2rem;
  }

  .alert-custom {
    border-radius: 15px;
    border: none;
    background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
    color: white;
    box-shadow: 0 5px 15px rgba(0, 184, 148, 0.3);
  }

  .container-custom {
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    min-height: 100vh;
    padding: 2rem 0;
  }

  .navbar-brand-custom {
    font-weight: 700;
    font-size: 1.3rem;
    color: white !important;
  }

  .nav-link-custom {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .nav-link-custom:hover {
    color: white !important;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
  }

  .role-tag {
    background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
  }

  .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  /* Mobile First Responsive Design */
  @media (max-width: 576px) {
    .container-custom {
      padding: 1rem 0;
    }

    .page-title {
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
    }

    .navbar-custom {
      border-radius: 10px;
      margin: 0 -15px;
    }

    .card-shadow {
      border-radius: 10px;
      margin: 0 -15px;
    }

    /* Hide table and show card layout */
    .table-responsive {
      display: none;
    }

    .mobile-cards {
      display: block;
    }

    .user-card {
      background: white;
      border-radius: 15px;
      margin-bottom: 1rem;
      padding: 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      border: 1px solid #f0f0f0;
    }

    .user-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .user-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .user-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      flex-shrink: 0;
    }

    .user-info h5 {
      margin: 0;
      font-weight: 600;
      color: #2d3436;
    }

    .user-info p {
      margin: 0;
      color: #636e72;
      font-size: 0.9rem;
    }

    .user-details {
      margin-bottom: 1rem;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 0;
      border-bottom: 1px solid #f8f9fa;
    }

    .detail-row:last-child {
      border-bottom: none;
    }

    .detail-label {
      font-weight: 500;
      color: #636e72;
      font-size: 0.9rem;
    }

    .mobile-actions {
      display: flex;
      gap: 0.5rem;
      justify-content: center;
    }

    .mobile-actions .btn-custom {
      flex: 1;
      font-size: 0.8rem;
      padding: 0.5rem 1rem;
    }
  }

  @media (min-width: 577px) and (max-width: 768px) {
    .action-buttons {
      flex-direction: column;
      align-items: center;
      gap: 4px;
    }

    .btn-custom {
      width: 100px;
      font-size: 0.8rem;
      padding: 6px 12px;
    }

    .page-title {
      font-size: 2rem;
    }

    .user-info h5 {
      font-size: 0.9rem;
    }

    .user-info div {
      font-size: 0.8rem;
    }
  }

  @media (min-width: 769px) and (max-width: 992px) {
    .btn-custom {
      font-size: 0.85rem;
      padding: 6px 16px;
    }

    .action-buttons {
      gap: 6px;
    }
  }

  @media (min-width: 993px) {
    .mobile-cards {
      display: none;
    }

    .table-responsive {
      display: block;
    }
  }

  /* Always hide mobile cards on larger screens */
  .mobile-cards {
    display: none;
  }
</style>

<div class="container-custom">
  <div class="container">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
      <div class="container-fluid">
        <a class="navbar-brand navbar-brand-custom" href="#">
          <i class="fas fa-users-cog me-2"></i>ระบบจัดการผู้ใช้งาน
        </a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-custom" href="/dashboard">
                <i class="fas fa-tachometer-alt me-1"></i>Dashboard
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Title -->
    <div class="text-center mb-4">
      <h1 class="page-title">
        <i class="fas fa-users me-3"></i>จัดการผู้ใช้งาน
      </h1>
    </div>

    <!-- Success Alert -->
    @if(session('msg'))
    <div class="alert alert-custom alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('msg') }}
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Users Table Card - Desktop View -->
    <div class="card card-shadow">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-custom mb-0">
            <thead>
              <tr>
                <th class="text-center d-none d-lg-table-cell" style="width: 80px;">
                  <i class="fas fa-hashtag me-1"></i>ID
                </th>
                <th>
                  <i class="fas fa-user me-1"></i>ชื่อ
                </th>
                <th class="d-none d-md-table-cell">
                  <i class="fas fa-envelope me-1"></i>อีเมล
                </th>
                <th class="text-center" style="width: 120px;">
                  <i class="fas fa-circle me-1"></i>สถานะ
                </th>
                <th class="text-center d-none d-lg-table-cell" style="width: 120px;">
                  <i class="fas fa-user-tag me-1"></i>บทบาท
                </th>
                <th class="text-center" style="width: 200px;">
                  <i class="fas fa-cogs me-1"></i>การจัดการ
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $u)
              <tr>
                <td class="text-center align-middle d-none d-lg-table-cell">
                  <strong>#{{ $u['id'] }}</strong>
                </td>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2 me-md-3"
                      style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;">
                      <span class="text-white fw-bold" style="font-size: 0.8rem;">{{ strtoupper(substr($u['name'], 0, 1)) }}</span>
                    </div>
                    <div>
                      <strong style="font-size: 0.9rem;">{{ $u['name'] }}</strong>
                      <div class="d-md-none text-muted" style="font-size: 0.8rem;">
                        <i class="fas fa-envelope me-1"></i>{{ $u['email'] }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="align-middle d-none d-md-table-cell">
                  <i class="fas fa-envelope text-muted me-2"></i>{{ $u['email'] }}
                </td>
                <td class="text-center align-middle">
                  @if($u['status'] === 'active')
                  <span class="status-badge status-active" style="font-size: 0.75rem; padding: 4px 8px;">
                    <i class="fas fa-check-circle me-1 d-none d-sm-inline"></i>
                    <span class="d-none d-sm-inline">Active</span>
                    <i class="fas fa-check d-sm-none"></i>
                  </span>
                  @else
                  <span class="status-badge status-blocked" style="font-size: 0.75rem; padding: 4px 8px;">
                    <i class="fas fa-ban me-1 d-none d-sm-inline"></i>
                    <span class="d-none d-sm-inline">Blocked</span>
                    <i class="fas fa-times d-sm-none"></i>
                  </span>
                  @endif
                </td>
                <td class="text-center align-middle d-none d-lg-table-cell">
                  <span class="role-tag">
                    <i class="fas fa-user-shield me-1"></i>{{ $u['role'] }}
                  </span>
                </td>
                <td class="text-center align-middle">
                  <div class="action-buttons">
                    <!-- Reset Password -->
                    <form action="{{ url('/admin/users/reset/'.$u['id']) }}" method="POST" style="display:inline;">
                      @csrf
                      <button class="btn btn-custom btn-reset btn-sm"
                        onclick="return confirm('🔑 Reset password ผู้ใช้นี้?')"
                        title="Reset Password">
                        <i class="fas fa-key me-1 d-none d-sm-inline"></i>
                        <span class="d-none d-sm-inline">Reset</span>
                        <i class="fas fa-key d-sm-none"></i>
                      </button>
                    </form>

                    <!-- Block User -->
                    <form action="{{ url('/admin/users/block/'.$u['id']) }}" method="POST" style="display:inline;">
                      @csrf
                      <button class="btn btn-custom btn-block btn-sm"
                        onclick="return confirm('🚫 Block ผู้ใช้นี้?')"
                        title="Block User">
                        <i class="fas fa-ban me-1 d-none d-sm-inline"></i>
                        <span class="d-none d-sm-inline">Block</span>
                        <i class="fas fa-ban d-sm-none"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-5">
                  <div class="text-muted">
                    <i class="fas fa-users fa-3x mb-3" style="opacity: 0.3;"></i>
                    <h5>ยังไม่มีผู้ใช้งาน</h5>
                    <p class="d-none d-md-block">ระบบยังไม่มีข้อมูลผู้ใช้งานในขณะนี้</p>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-cards">
      @forelse($users as $u)
      <div class="user-card">
        <div class="user-header">
          <div class="user-avatar">
            <span class="text-white fw-bold">{{ strtoupper(substr($u['name'], 0, 1)) }}</span>
          </div>
          <div class="user-info">
            <h5>{{ $u['name'] }}</h5>
            <p><i class="fas fa-envelope me-1"></i>{{ $u['email'] }}</p>
          </div>
        </div>

        <div class="user-details">
          <div class="detail-row">
            <span class="detail-label"><i class="fas fa-hashtag me-1"></i>ID:</span>
            <strong>#{{ $u['id'] }}</strong>
          </div>
          <div class="detail-row">
            <span class="detail-label"><i class="fas fa-circle me-1"></i>สถานะ:</span>
            @if($u['status'] === 'active')
            <span class="status-badge status-active">
              <i class="fas fa-check-circle me-1"></i>Active
            </span>
            @else
            <span class="status-badge status-blocked">
              <i class="fas fa-ban me-1"></i>Blocked
            </span>
            @endif
          </div>
          <div class="detail-row">
            <span class="detail-label"><i class="fas fa-user-tag me-1"></i>บทบาท:</span>
            <span class="role-tag">
              <i class="fas fa-user-shield me-1"></i>{{ $u['role'] }}
            </span>
          </div>
        </div>

        <div class="mobile-actions">
          <!-- Reset Password -->
          <form action="{{ url('/admin/users/reset/'.$u['id']) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-custom btn-reset"
              onclick="return confirm('🔑 Reset password ผู้ใช้นี้?')"
              title="Reset Password">
              <i class="fas fa-key me-1"></i>Reset
            </button>
          </form>

          <!-- Block User -->
          <form action="{{ url('/admin/users/block/'.$u['id']) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-custom btn-block"
              onclick="return confirm('🚫 Block ผู้ใช้นี้?')"
              title="Block User">
              <i class="fas fa-ban me-1"></i>Block
            </button>
          </form>
        </div>
      </div>
      @empty
      <div class="text-center py-5">
        <div class="text-muted">
          <i class="fas fa-users fa-3x mb-3" style="opacity: 0.3;"></i>
          <h5>ยังไม่มีผู้ใช้งาน</h5>
          <p>ระบบยังไม่มีข้อมูลผู้ใช้งานในขณะนี้</p>
        </div>
      </div>
      @endforelse
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
      <a href="/dashboard" class="btn btn-custom btn-back btn-lg">
        <i class="fas fa-arrow-left me-2"></i>ย้อนกลับไปยัง Dashboard
      </a>
    </div>
  </div>
</div>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection