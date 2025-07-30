<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'ระบบจัดการรถยนต์')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background: rgba(255, 255, 255, 0.95) !important;
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .main-content {
      flex: 1;
      padding: 2rem 0;
    }

    .welcome-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      border: none;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .welcome-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .card-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
      border-radius: 20px 20px 0 0 !important;
      padding: 1.5rem;
    }

    .menu-item {
      border: none !important;
      padding: 1rem 1.5rem;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .menu-item:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transform: translateX(10px);
    }

    .menu-item:hover a {
      color: white !important;
    }

    .menu-item a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu-item:last-child:hover {
      background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    }

    .footer {
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(10px);
      color: white;
      padding: 2rem 0;
      margin-top: auto;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .footer-links a {
      color: #ccc;
      text-decoration: none;
      margin: 0 15px;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: #667eea;
    }

    .social-icons a {
      color: #ccc;
      font-size: 1.2rem;
      margin: 0 10px;
      transition: all 0.3s ease;
    }

    .social-icons a:hover {
      color: #667eea;
      transform: translateY(-2px);
    }

    .brand-logo {
      font-weight: bold;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    @media (max-width: 768px) {
      .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
      }

      .navbar-brand {
        font-size: 1.1rem;
      }
    }

    .menu-item a {
      display: block;
      padding: 12px;
      font-size: 1.05rem;
      font-weight: 500;
      color: #333;
      text-decoration: none;
      transition: all 0.2s ease-in-out;
      border-radius: 8px;
    }

    .menu-item a:hover {
      background-color: #ccc;
      transform: translateX(5px);
      color: #0d6efd;
    }

    .menu-item i {
      width: 24px;
      text-align: center;
    }
  </style>
</head>

<body>

  <x-nav />

  <!-- Main Content -->
  <div class="main-content" style="margin-top: 80px;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
            <!-- Header -->
            <div class="card-header bg-primary text-white text-center py-4">
              <h4 class="mb-1">
                <i class="fas fa-home me-2"></i>ยินดีต้อนรับ, {{ session('user')['name'] }}
              </h4>
              <p class="mb-0 opacity-75">เลือกเมนูที่ต้องการใช้งาน</p>
            </div>

            <!-- Body -->
            <div class="card-body p-0">
              <ul class="list-group list-group-flush">
                <!-- Menu Item -->
                <li class="list-group-item menu-item">
                  <a href="/cars" class="d-flex align-items-center">
                    <i class="fas fa-warehouse fa-lg text-primary me-3"></i>
                    <span>จัดการคลังรถ</span>
                  </a>
                </li>

                <li class="list-group-item menu-item">
                  <a href="/loan" class="d-flex align-items-center">
                    <i class="fas fa-calculator fa-lg text-success me-3"></i>
                    <span>คำนวณยอดผ่อน</span>
                  </a>
                </li>

                @if(session('user')['role'] === 'admin')
                <li class="list-group-item menu-item">
                  <a href="/admin/users" class="d-flex align-items-center">
                    <i class="fas fa-users-cog fa-lg text-warning me-3"></i>
                    <span>จัดการผู้ใช้</span>
                  </a>
                </li>
                @endif

                <li class="list-group-item menu-item">
                  <a href="/logout" class="d-flex align-items-center text-danger">
                    <i class="fas fa-sign-out-alt fa-lg me-3"></i>
                    <span>ออกจากระบบ</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-footer />

</body>

</html>