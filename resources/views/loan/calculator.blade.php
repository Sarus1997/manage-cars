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

  <section class="container mt-4">
    <h3>Loan Calculator</h3>
    <div class="mb-2">
      <input type="number" id="amount" class="form-control" placeholder="ยอดจัด">
    </div>
    <div class="mb-2">
      <input type="number" id="rate" class="form-control" placeholder="ดอกเบี้ย % ต่อปี">
    </div>
    <div class="mb-2">
      <input type="number" id="terms" class="form-control" placeholder="จำนวนงวด">
    </div>
    <button id="calcBtn" class="btn btn-primary">คำนวณ</button>
    <button id="clearBtn" class="btn btn-secondary" style="display:none">เคลียร์</button>

    <table class="table mt-3" id="resultTable">
      <thead>
        <tr>
          <th>งวด</th>
          <th>ยอดผ่อน</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </section>

  <x-footer />
  <script>
    function validateInput(id) {
      let val = $(id).val();
      if (val < 0 || isNaN(val)) {
        alert("กรุณาใส่ตัวเลขที่ถูกต้อง");
        $(id).val('');
      }
    }

    $('#amount').on('input', function() {
      validateInput(this);
    });
    $('#rate').on('input', function() {
      validateInput(this);
    });
    $('#terms').on('input', function() {
      validateInput(this);
    });

    $('#calcBtn').click(function() {
      $.post('/loan/calculate', {
        _token: "{{ csrf_token() }}",
        amount: $('#amount').val(),
        rate: $('#rate').val(),
        terms: $('#terms').val()
      }, function(res) {
        let tbody = $('#resultTable tbody');
        tbody.empty();
        res.forEach(r => {
          let row = `<tr data-terms="${r.terms}" class="${r.payment>5000?'table-danger':''}">
                <td>${r.terms}</td><td>${r.payment}</td>
            </tr>`;
          tbody.append(row);
        });
        $('#clearBtn').show();
      });
    });

    $(document).on('click', '#resultTable tr', function() {
      $('#resultTable tr').removeClass('table-primary');
      $(this).addClass('table-primary');
    });

    $('#clearBtn').click(function() {
      $('#amount,#rate,#terms').val('');
      $('#resultTable tbody').empty();
      $(this).hide();
    });
  </script>

</body>

</html>