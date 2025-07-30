<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Car Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

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
</style>

<x-nav />

<body>

  <br>
  <br>

  <br>
  <br>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-header bg-gradient text-white text-center"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h4 class="mb-0"><i class="fas fa-calculator me-2"></i> คำนวณยอดผ่อนรถ</h4>
          </div>
          <div class="card-body p-4">
            <form id="loanForm">
              <div class="mb-3">
                <label for="amount" class="form-label">ราคารถ (บาท)</label>
                <input type="number" class="form-control" id="amount" required>
              </div>
              <div class="mb-3">
                <label for="rate" class="form-label">อัตราดอกเบี้ย (%)</label>
                <input type="number" step="0.01" class="form-control" id="rate" required>
              </div>
              <div class="mb-3">
                <label for="months" class="form-label">จำนวนเดือนผ่อน</label>
                <input type="number" class="form-control" id="months" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-calculator"></i> คำนวณ
              </button>
            </form>

            <div id="result" class="alert alert-info mt-4 d-none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-footer />

  <script>
    document.querySelector("#loanForm").addEventListener("submit", async function(e) {
      e.preventDefault();

      let amount = document.getElementById("amount").value;
      let rate = document.getElementById("rate").value;
      let months = document.getElementById("months").value;

      let res = await fetch("/loan/calculate", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          amount,
          rate,
          months
        })
      });

      let data = await res.json();
      let resultDiv = document.getElementById("result");
      resultDiv.classList.remove("d-none");
      resultDiv.innerHTML = `ค่างวดต่อเดือน: <strong>${data.installment.toLocaleString()} บาท</strong>`;
    });
  </script>

</body>

</html>